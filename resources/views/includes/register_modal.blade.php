<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header custom-content-center p-4">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <!-- Your register form here -->
                <form method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="registerEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="registerPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="registerPassword" required>
                    </div>
                    <div class="d-flex custom-content-center">
                        <button type="submit" class="btn success large">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>