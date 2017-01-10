<?php
use yii\helpers\Html;
?>

<div class="backend-content-wrap">
    <div class="backend-content-header">
        <div>
            <div class="backend-content-title">
                <div>
                    <span>Страницы</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/pages-add">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            Новая страница
                        </span>
                        </div>
                    </button>
                </div>
            </a>
            <?php if ($id > 0) {?>
                <a href="/backend/pages">
                    <div class="btn-wrap">
                        <button class="blue-btn" tabindex="0" type="button">
                            <div>
                        <span>
                            В корень
                        </span>
                            </div>
                        </button>
                    </div>
                </a>
            <?php }?>
        </div>
    </div>
    <div class="backend-content-body">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent ID</th>
                <th>Active</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($pages as $page) {
                echo '<tr>';
                echo '<td>' . $page->id . '</td>';
                echo '<td><a href="/backend/pages?id=' . $page->id . '">' . $page->name . '</a></td>';
                echo '<td>' . $page->parent_id . '</td>';
                echo '<td>' . $page->active . '</td>';
                echo '<td>' . Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', '/backend/pages-edit?id=' . $page->id) . "&nbsp;";
                echo Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', '/backend/pages-delete?id=' . $page->id) . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>