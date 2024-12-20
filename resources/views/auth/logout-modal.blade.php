

<form action="{{route('logout')}}">
    @csrf
    <div class="modal fade" id="logoutModal"  tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Logout</h5>
                <lord-icon class="close" data-bs-dismiss="modal" aria-label="Close"
                    src="https://cdn.lordicon.com/zxvuvcnc.json"
                    trigger="hover"
                    state="hover-cross-3"
                    style="width:30px;height:30px">
                </lord-icon>
            </div>
            <div class="modal-body">
              <p>Are you aure you want to logout?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Logout</button>
            </div>
          </div>
        </div>
      </div>
</form>
