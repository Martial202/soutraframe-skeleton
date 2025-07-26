<div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general"
    aria-expanded="true">
    <div class="media">
        <h3>Liste des familles <?=Validator::icon('list'); ?></h3>
    </div>
    <hr>
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">

            <table class="table table-striped table-bordered database-ville">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>LIBELLE FAMILLE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $i = 0;
                if (!empty($familles)) {
                    foreach ($familles as  $value) {
                        ++$i;
            $cryptedParams = $this->validator->crypter($value['id_famille']); ?>
                    <tr>
                        <td><?=$i; ?></td>
                        <td><?= Validator::decodeTexteEntites($value['libelle_famille']) ?></td>
                        <td class="justify-content">
                            <a href="<?=RACINE_2 ?>produit/famille/<?=$cryptedParams; ?>" class="badge badge-primary"><?=Validator::icon('edit'); ?> Modifier</a>
                            <a onclick="changeDeleteById('familleControllers/change',<?= $value['id_famille'] ?>)" class="badge badge-danger text-white">
                                <?= Validator::icon('trash'); ?> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                } ?>

                </tbody>

            </table>
        </div>
    </div>
</div>