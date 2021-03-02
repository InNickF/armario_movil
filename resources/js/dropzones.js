Dropzone.autoDiscover = false

$(document).ready(function () {
  function addImageToTextInput(newPath, inputId) {
    var pathsInput = $("#" + inputId).val()
    try {
      paths = JSON.parse(pathsInput)
    } catch (error) {
      paths = []
    }

    if (newPath.length && Array.isArray(newPath)) {
      paths.push(newPath[0])
    }

    $("#" + inputId).val(JSON.stringify(paths))
  }

  function removeFileFromTextInput(file, inputId) {
    if (file.xhr == undefined) {
      return
    }
    var removePath = JSON.parse(file.xhr.response).data

    var pathsInputVal = $("#" + inputId).val()

    try {
      paths = JSON.parse(pathsInputVal)
    } catch (error) {
      console.error(error)
      paths = []
    }

    paths = paths.filter(function (path) {
      return path != removePath
    })

    $("#" + inputId).val(JSON.stringify(paths))
  }


  function createMultipleFileDropzone(selector) {
    var productImagesFormDropzone = new Dropzone(selector, {
      url: $(selector).attr('dropzone-url'),
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 5.0, // MB
      maxFiles: 10,
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      dictRemoveFile: 'Eliminar',
      dictFileTooBig: 'Archivo demasiado grande ({{filesize}}MB). Máximo permitido: {{maxFilesize}}MB',
      renameFile: "product_image",
      init: function () {
        this.on("success", function (file, responseText) {
          addImageToTextInput(responseText.data, selector + "-input")
        })
        this.on("removedfile", function (file) {
          removeFileFromTextInput(file, selector + "-input")
        })
        this.on("error", function (file, errorMessage) {
          alert(JSON.stringify(errorMessage))
          this.removeFile(file)
        })
      }
    })

    $(selector + " .dropzone-sortable").sortable({
      items: "> .dz-preview",
      cursor: "move",
      opacity: 0.5,
      containment: ".dropzone-sortable",
      distance: 20,
      tolerance: "pointer",
      update: function (e, ui) {
        draggedItem = ui.item;
        files = e.target.dropzone.files;

        console.log('Dragged:', draggedItem);
        // console.log('files:', e.target.dropzone.files);

        draggedImageSrc = draggedItem.find('img')[0].src;
        // console.log('image dragged:', draggedImageSrc);

        image = files.filter(function (file) {
          console.log(file.dataURL == draggedImageSrc);
          return file.dataURL == draggedImageSrc
        })
        console.log('found image in files: ', image)
      }
    })



  }








  // REGISTER DROPZONES
  // createSingleFileDropzone("div#product-main-image-form")
  // createMultipleFileDropzone("div#product-images-form")

  // console.log("initialized dropzones")
})
