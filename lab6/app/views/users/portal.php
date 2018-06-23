<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1 class="display-4">Welecome <?= $data->firstName . " ". $data->lastName ?></h1>
        <p class="lead">My Apis</p>
        <div class="row">
            <?php if($params) :?>
            <div class="col-8">
                <div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Api Key</th>
                            </tr>
                        </thead>
                        <tbody>   
                            <?php foreach ($params as $api) :?>
                            <tr>
                                <th scope="row"><?= $api->id ?></th>
                                <td><?= $api->apiKey ?></td>
                            </tr>
                            <?php endforeach; ?>            
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
            <p>No api created yet</p>
            <?php endif; ?>
        </div>
        

    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 