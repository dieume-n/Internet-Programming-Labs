<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-body bg-light mt-5">
                    <h2>Register</h2>
                    <p>Please fill out this form to register with us</p>
                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="firstName">Firstname: *</label>
                                    <input type="text" name="firstName" class="form-control <?php echo (!empty($data['firstName_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['firstName']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['firstName_error'] ?></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="lastName">Lastname: *</label>
                                    <input type="text" name="lastName" class="form-control <?php echo (!empty($data['lastName_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['lastName']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['lastName_error'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">City: *</label>
                            <input type="text" name="city" class="form-control <?php echo (!empty($data['city_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['city']; ?>">
                            <span class="invalid-feedback"><?php echo $data['city_error'] ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Register" class="form-control btn btn-success btn-block">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT;?>/users/list" class="btn btn-light btn-block">List of users</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?> 