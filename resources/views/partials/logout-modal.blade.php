<!-- Logout Modal-->
<div style="z-index:99999999999;" class="modal-bg">
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-grey-gradient border-0">
            <div class="modal-header ml-3">
                <h5 class="modal-title text-primary h2" id="exampleModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-primary border-0 ml-3 h3">Confirma que deseas cerrar tu sesión</div>
            <div class="modal-footer border-0">
                <button class="btn btn-flat btn-sm text-primary" type="button" data-dismiss="modal">Cancelar</button>
                <a href="{!! url('/logout') !!}" class="btn btn-default btn-sm btn-outline-transparent" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); localStorage.removeItem('userId'); ">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
</div>
