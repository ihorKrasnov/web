<?php

    /** @var yii\web\View $this */

    use yii\helpers\Html;
    use \app\models\EntryForm;

    $this->title = 'Entry';
    $this->params['breadcrumbs'][] = $this->title;
    $model = new EntryForm();
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->input('email') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php \yii\widgets\ActiveForm::end(); ?>

    <?php if ($model->load(Yii::$app->request->post()) && $model->validate()): ?>
        <div class="alert alert-success">
            <p>Name: <?= Html::encode($model->name) ?></p>
            <p>Email: <?= Html::encode($model->email) ?></p>
        </div>
    <?php endif; ?>
    
    <code><?= __FILE__ ?></code>
</div>
