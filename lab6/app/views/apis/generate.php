<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h1 class="display-3"><?php echo $data['title']; ?></h1>
                <p class="lead">Version: <?php echo APPVERSION; ?></p>
                <p class="lead"><?php echo $data['description']; ?></p>
                <div class="row">
                <div class="card card-body bg-light mt-3">
                    <?php Session::flash('api_fail') ?>
                    <h2>Generate Api key</h2>
                    <form action="<?php echo URLROOT; ?>/apis/generate" method="post">
                        <div class="row">
                            <div class="col-2">
                                <input type="submit" value="Generate Api Key" class="form-control btn btn-primary btn-block">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1 mt-2">
                                API KEY:
                            </div>
                            <div class="col-11 mt-2">
                                <div class="form-group">
                                    <input type="text" name="api" class="form-control <?php echo (!empty($data['api_error'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['api']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['api_error'] ?></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>       
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 