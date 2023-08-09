<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header custom-content-center p-4">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <!-- Your login form here -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="loginPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="loginPassword" required>
                    </div>
                    <div class="d-flex custom-content-center">
                        <button type="submit" class="btn success large">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>