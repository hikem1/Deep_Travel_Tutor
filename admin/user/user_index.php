<?php
require_once '../adminAuthentification.php';
require '../../vendor/autoload.php';
use App\repository\UserRepository;

$userRepo = new UserRepository();
$usersCount = $userRepo->getDataCount();


$paginator = new Nette\Utils\Paginator;
$paginator->setItemCount($usersCount);
$paginator->setItemsPerPage(10);
$paginator->setPage($_GET['page']);

$users = $userRepo->findAll($paginator->getLength(), $paginator->getOffset());

$page = 'admin';
include_once '../../partial/header.php';
?>

<div class="admin-container my-5">
    <a class="text-decoration-none text-light" href="../index.php"><i class="me-2 fa-sharp fa-solid fa-circle-chevron-left fa-xl"></i>Tableau de bord</a>
    <table class="mt-5 white">
        <thead class="fs-5 copperplate ">
            <tr class="bg-dark">
                <th class="bg-dark">Nom</th>
                <th class="bg-dark">Prénom</th>
                <th class="bg-dark">Email</th>
                <th class="bg-dark">Role</th>
                <th class="bg-dark">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($users as $user){?>
            <tr>
                <th><?= $user->getLastname() ?></th>
                <th><?= $user->getFirstname() ?></th>
                <th><?= $user->getEmail() ?></th>
                <th><?= $user->getRole() ?></th>
                <th>
                    <a class="btn btn-dark rounded-circle" href="./user_show.php?id=<?= $user->getId() ?>"><i id="login-icon" class="fa-solid fa-user-astronaut fa-l"></i></a>
                    <a class="btn btn-warning mx-2 rounded-circle" href="./user_update.php?id=<?= $user->getId() ?>"><i class="fa-solid fa-pen fa-l"></i></a>
                    <a id="" user="<?= $user->getId() ?>" class="btn btn-danger delete-btn rounded-circle" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-trash fa-l"></i></a>
                </th>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?php for ($i = 0; $i < $paginator->getPageCount(); $i++){?>
            <a class="mt-3 mx-2 btn border rounded" href="user_index.php?page=<?= $i + 1 ?>"><?= $i + 1 ?></a>
        <?php }?>
    </div>
    </div>


<?php
$modalTextContent = 'Etes vous sur de vouloir supprimer l\'Utilisateur N° ';
include_once '../../partial/modalConfirm.php'
?>

<?php
include_once '../../partial/footer.php'
?>
