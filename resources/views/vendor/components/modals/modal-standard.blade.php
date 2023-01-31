<div class="modal fade text-left" id="@yield('modal-id')" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable @yield('modal-size')" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">@yield('modal-header')</h4>
                <button type="button" class="close btn btn-link btnCloseModal" data-dismiss="modal" aria-label="Close" data-modal="#@yield('modal-id')">
                    <i class="fas fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal-body')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary btnCloseModal" data-dismiss="modal" data-modal="#@yield('modal-id')">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cerrar</span>
                </button>
                @yield('modal-btn')
            </div>
        </div>
    </div>
</div>