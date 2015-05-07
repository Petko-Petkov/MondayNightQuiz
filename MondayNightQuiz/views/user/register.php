
<!--<section class="modal fade" id="register-form" role="dialog">-->
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST">
                <div class="modal-header">
                    <h4>Register</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first-name" class="col-lg-3 control-label">First name: </label>

                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="first-name" name="firstName" placeholder="First name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last-name" class="col-lg-3 control-label">Last name: </label>

                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="last-name" name="lastName" placeholder="Last name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-name-register" class="col-lg-3 control-label">Username: </label>

                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="user-name-register" name="username" placeholder="Username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-password-register" class="col-lg-3 control-label">Password:</label>

                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="user-password-register" name="password"
                                   placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-repeatPassword-register" class="col-lg-3 control-label">Repeat password:</label>

                        <div class="col-lg-9">
                            <input type="password" class="form-control" id="user-repeatPassword-register" name="repeatPassword"
                                   placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-email-register" class="col-lg-3 control-label">Email: </label>

                        <div class="col-lg-9">
                            <input type="email" class="form-control" id="user-email-register" name="email" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="team-id" class="col-lg-3 control-label">Team:</label>

                        <div class="col-lg-9">
                            <select class="form-control" id="team-id" name="team"/>
                            <?php
                            foreach($teams as $team){
                                echo '<option name="team" value="' . $team['TeamId'] . '">' . $team['TeamName'] . '</option>>';
                            }?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Register" class="btn btn-danger" id="user-register-btn"/>
                    <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>-->
                </div>
            </form>
        </div>
    </div>
<!--</section>-->
