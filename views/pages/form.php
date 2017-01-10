<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

?>
<div class="backend-content-wrap">
    <div class="backend-content-header">
        <div>
            <div class="backend-content-title">
                <div>
                    <span>Редактирование страницы</span>
                </div>
            </div>
        </div>
        <div class="backend-content-description">
            <a href="/backend/pages">
                <div class="btn-wrap">
                    <button class="blue-btn" tabindex="0" type="button">
                        <div>
                        <span>
                            К списку страниц
                        </span>
                        </div>
                    </button>
                </div>
            </a>
        </div>
    </div>
    <div class="backend-content-body">
        <h2>Основные поля</h2>
        <?php
        $form = ActiveForm::begin();
        ?>

        <div class="form-group">
            <?= $form->field($page, 'active')
                ->checkbox(
                    [
                        'value' => 1,
                        'label' => ''
                    ]
                )
                ->label('Активность');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'name')
                ->textInput(
                    [
                        'placeholder' => 'Название',
                        'value' => $page->name,
                        'class' => 'form-control'
                    ]
                )->label('Название');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'parent_id')
                ->dropDownList(
                    $pages
                )->label('Родительская категория');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'template_id')
                ->dropDownList(
                    $templates
                )->label('Шаблон');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'slug')
                ->textInput(
                    [
                        'placeholder' => 'Символьный код',
                        'value' => $page->slug,
                        'class' => 'form-control'
                    ]
                )->label('Символьный код');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'sort')
                ->textInput(
                    [
                        'placeholder' => 'Сортировка',
                        'value' => $page->sort,
                        'class' => 'form-control'
                    ]
                )->label('Сортировка');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'image')
                ->fileInput(
                    [
                        'placeholder' => 'Картинка'
                    ]
                )->label('Картинка');
            ?>
            <?php if ($image = $page->getImage()) {?>
                <?= $form->field($page, 'curr_image')
                    ->textInput(
                        [
                            'value' => $image,
                            'class' => 'form-control'
                        ]
                    )->label('Текущая картинка');
                ?>
                <img src="<?= $page->getPathImage()?>" width="100"/>
            <?php }?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'small_image')
                ->fileInput(
                    [
                        'placeholder' => 'Миниатюра'
                    ]
                )->label('Миниатюра');
            ?>
            <?php if ($image = $page->getSmallImage()) {?>
                <?= $form->field($page, 'curr_small_image')
                    ->textInput(
                        [
                            'value' => $image,
                            'class' => 'form-control'
                        ]
                    )->label('Текущая миниатюра');
                ?>
                <img src="<?= $page->getPathSmallImage()?>" width="100"/>
            <?php }?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'h1')
                ->textInput(
                    [
                        'placeholder' => 'h1',
                        'value' => $page->h1,
                        'class' => 'form-control'
                    ]
                )->label('h1');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'title')
                ->textInput(
                    [
                        'placeholder' => 'title',
                        'value' => $page->title,
                        'class' => 'form-control'
                    ]
                )->label('Title');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'description')
                ->textInput(
                    [
                        'placeholder' => 'description',
                        'value' => $page->description,
                        'class' => 'form-control'
                    ]
                )->label('Description');
            ?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'announce')->widget(CKEditor::className(), [
                'options' => ['rows' => 6]
            ])->label('Анонс');?>
        </div>

        <div class="form-group">
            <?= $form->field($page, 'text')->widget(CKEditor::className(), [
                'options' => ['rows' => 6]
            ])->label('Основной текст');?>
        </div>

        <div class="form-group">
            <h2>Параметры: </h2>
            <?php
            $i = 0;
            if ($params = $page->getParams()) {
                foreach ($params as $param => $value) {
                    ?>
                    <div class="form-inline row-<?= $i?>">
                        <?php
                        echo $form->field($page, 'params[' . $i . '][key]')
                            ->textInput(
                                [
                                    'placeholder' => 'Ключ',
                                    'value' => $param,
                                    'class' => 'form-control'
                                ]
                            )->label('');
                        echo $form->field($page, 'params[' . $i . '][value]')
                            ->textInput(
                                [
                                    'placeholder' => 'Значение',
                                    'value' => $value,
                                    'class' => 'form-control'
                                ]
                            )->label('');
                        ?>
                        <div class="form-group">
                            <?= Html::button('-', ['class' => 'btn btn-primary delete', 'data-id' => $i]);?>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>
        </div>

        <div class="form-group adding-fields">
            <div class="form-inline row-<?= $i?>">
                <?php
                echo $form->field($page, 'params[' . $i . '][key]')
                    ->textInput(
                        [
                            'placeholder' => 'Ключ',
                            'class' => 'form-control'
                        ]
                    )->label('');
                echo $form->field($page, 'params[' . $i . '][value]')
                    ->textInput(
                        [
                            'placeholder' => 'Значение',
                            'class' => 'form-control'
                        ]
                    )->label('');
                ?>
                <div class="form-group">
                    <?= Html::button('+', ['class' => 'btn btn-primary add', 'data-id' => $i, 'data-class' => 'Page']);?>
                    <div class="help-block"></div>
                </div>
            </div>
            <?php
            ?>
        </div>

        <div class="btn-wrap">
            <?= Html::submitButton('<div><span>Сохранить</span></div>', ['class' => 'blue-btn']);?>
        </div>
        <?php ActiveForm::end();?>
    </div>
</div>