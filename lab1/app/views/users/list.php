<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="container">
        <h1 class="display-3">List of users</h1>
        <?= Session::flash('register_success') ?>
        <div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">City</th>
                    </tr>
                </thead>
                <tbody>   
                    <?php foreach ($data as $user) :?>
                    <tr>
                        <th scope="row"><?= $user->id ?></th>
                        <td><?= $user->firstName ?></td>
                        <td><?= $user->lastName ?></td>
                        <td><?= $user->city ?></td>
                    </tr>
                    <?php endforeach; ?>            
                </tbody>
            </table>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?> 