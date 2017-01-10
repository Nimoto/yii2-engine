<?php
use yii\helpers\Html;
?>

<div class="backend-content-wrap">
    <div class="backend-content-header">
        <div>
            <div class="backend-content-title">
                <div>
                    <span>Шаблоны</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/templates-add">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            Новый шаблон
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
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($templates as $template) {
                echo '<tr>';
                echo '<td>' . $template->id . '</td>';
                echo '<td>' . $template->name . '</td>';
                echo '<td>' . $template->key . '</td>';
                echo '<td>' . Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', '/backend/templates-edit?id=' . $template->id) . "&nbsp;";
                echo Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', '/backend/templates-delete?id=' . $template->id) . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>