<?php
    require_once "../controllers/users/UserController.php";
    $users = AfficherUtilisateur();
?>

<div class="container shadow mt-3 p-2">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Changer rôle</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user["id_user"] ?></td>
                <td><?= $user["email_user"] ?></td>
                <td><?= $user["role_user"] == 1 ? "Admin" : "Utilisateur" ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Changer le statut de cet utilisateur ?')">
                        <input type="hidden" name="user_id" value="<?= $user["id_user"] ?>">
                        <select name="role" class="form-control form-select-sm">
                            <option value="0" <?= $user["role_user"] == 0 ? "selected" : "" ?>>Utilisateur</option>
                            <option value="1" <?= $user["role_user"] == 1 ? "selected" : "" ?>>Admin</option>
                        </select>
                        <button name="change_role" class="btn btn-primary btn-sm mt-1">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        <?php
            if(isset($_POST["change_role"])){
                ChangerRoleUtilisateur();
                header("Location: administration-utilisateur");
            }
            ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

