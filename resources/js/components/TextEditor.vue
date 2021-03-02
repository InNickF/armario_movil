<template>
  <div>
    <div>
      <tinymce :api-key="apiKey" :init="config" v-model="content"></tinymce>
    </div>

    <input type="hidden" v-model="content" name="body">
  </div>
</template>

<script>
export default {
  props: {
    old: null
  },

  mounted() {
    if (this.old && this.old != "null") {
      this.content = this.old;
    }
  },

  data() {
    return {
      content: "",
      config: {
        relative_urls: false,
        // toolbar: [
        //   ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
        // ],
        plugins: "link image code media",
        file_picker_callback: function(cb, value, meta) {
          var input = document.createElement("input");
          input.setAttribute("type", "file");
          input.setAttribute("accept", "image/*,video/*");

          /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

          input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = (e) => {
              /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        // */
              var id = "blobid" + new Date().getTime();
              var blobCache = tinymce.activeEditor.editorUpload.blobCache;
              var base64 = reader.result.split(",")[1];
              var blobInfo = blobCache.create(id, file, base64);
              blobCache.add(blobInfo);

              var xhr, formData;
              xhr = new XMLHttpRequest();
              xhr.withCredentials = false;
              xhr.open("POST", process.env.MIX_API_URL + "/videos/store");
              xhr.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector('meta[name="csrf-token"]').content);
              xhr.setRequestHeader("Accept", "application/json");
              xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
              xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                  alert("HTTP Error: " + xhr.status);
                  return false;
                }

                console.log("response:", xhr.responseText);
                json = JSON.parse(xhr.responseText);

                if (!json) {
                  alert("Invalid JSON: " + xhr.responseText);
                  return false;
                }
                cb(process.env.MIX_APP_URL + "/storage/" + json.data[0]);
              };
              formData = new FormData();
              formData.append("file", blobInfo.blob());
              xhr.send(formData);

              /* call the callback and populate the Title field with the file name */
              // cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
          };

          input.click();
        },
        toolbar:
          "styleselect bold italic alignleft aligncenter alignright | link image media",
        // setup: editor => {
        //   editor.ui.registry.addButton("uploadFile", {
        //     text: "Video",
        //     onAction: () => alert("Button clicked!")
        //   });
        // },
        file_picker_types: 'media',
        // images_upload_url: process.env.MIX_API_URL + "/images/store",
        images_upload_handler: (blobInfo, success, failure) => {
          console.log("sending image", blobInfo);
          var xhr, formData;
          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open("POST", process.env.MIX_API_URL + "/images/store");
          xhr.setRequestHeader("X-CSRF-TOKEN", this.getToken());
          xhr.setRequestHeader("Accept", "application/json");
          xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
              failure("HTTP Error: " + xhr.status);
              return;
            }

            console.log("response:", xhr.responseText);
            json = JSON.parse(xhr.responseText);

            if (!json) {
              failure("Invalid JSON: " + xhr.responseText);
              return;
            }
            success(process.env.MIX_APP_URL + "/storage/" + json.data[0]);
          };
          formData = new FormData();
          formData.append("file", blobInfo.blob());
          xhr.send(formData);
        }
        // images_upload_handler: function(blobInfo, success, failure) {
        //   console.log(blobInfo);
        //   setTimeout(function() {
        //     /* no matter what you upload, we will turn it into TinyMCE logo :)*/
        //     success("http://moxiecode.cachefly.net/tinymce/v9/images/logo.png");
        //   }, 2000);
        // }
        // filebrowserBrowseUrl: this.$root.baseUrl + "/api/images/store",
        // filebrowserUploadUrl: this.$root.baseUrl + "/api/images/store"
      },
      apiKey: process.env.MIX_TINY_MCE_KEY
    };
  },
  methods: {
    getToken() {
      return document.head.querySelector('meta[name="csrf-token"]').content;
    },
    onBlur(evt) {
      console.log(evt);
    },
    onFocus(evt) {
      console.log(evt);
    },
    onContentDom(evt) {
      console.log(evt);
    },
    onDialogDefinition(evt) {
      console.log(evt);
    },
    onFileUploadRequest(evt) {
      console.log(evt);
    },
    onFileUploadResponse(evt) {
      console.log(evt);
    }
  }
};
</script>