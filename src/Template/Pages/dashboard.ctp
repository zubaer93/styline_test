<section id="middle">

    <div id="content" class="padding-20">
        <!-- page title -->
        <div class="panel-body">
            <div class="card card-default">
                <div class="card-heading card-heading-transparent">
                    <h2 class="card-title"><?= __('Add Card Cons'); ?></h2>
                </div>

                <div class="card-block">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label><?= __('Cons *'); ?></label>
                                <?= $this->Form->control('cons', ['required' => true, 'type' => 'text', 'class' => 'form-control', 'label' => false]); ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <?= $this->Form->button('<i class="fa fa-check"></i>' . __('SAVE'), ['class' => 'btn btn-primary btn-lg btn-block']); ?>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>

</section>
