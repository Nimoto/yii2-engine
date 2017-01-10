<?php
use yii\helpers\Html;
?>

<div class="backend-content-wrap">
    <div class="backend-content-header">
        <div>
            <div class="backend-content-title">
                <div>
                    <span>Блоки</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/blocks-add">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            Новый блок
                        </span>
                        </div>
                    </button>
                </div>
            </a>
        </div>
    </div>
    <div class="backend-content-body">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Key</th>
                <th>View</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($blocks as $block) {
                echo '<tr>';
                echo '<td>' . $block->id . '</td>';
                echo '<td>' . $block->name . '</td>';
                echo '<td>' . $block->key . '</td>';
                echo '<td>' . $block->view . '</td>';
                echo '<td>' . Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', '/backend/blocks-edit?id=' . $block->id) . "&nbsp;";
                echo Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', '/backend/blocks-delete?id=' . $block->id) . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>