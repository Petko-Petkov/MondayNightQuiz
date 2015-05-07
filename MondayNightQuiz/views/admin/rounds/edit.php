<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="well bs-component">
        <form method="POST" class="form-horizontal">
            <fieldset>
                <legend>Редактирай кръг</legend>
                <div class="form-group">
                    <label for="select" class="col-lg-3 control-label">Име: </label>
                    <div class="col-lg-9">
                        <?php echo '<input type="text" value="' . $round[0]['name'] . '" name="name" class="form-control"/>'; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-lg-3 control-label">Номер: </label>
                    <div class="col-lg-9">
                        <?php echo '<input type="text" value="' . $round[0]['roundNumber'] . '" name="roundNumber" class="form-control"/>';?>
                    </div>
                </div>
                <?php echo '<input type="hidden" name="id" value="' . $round[0]['roundId'] . '">'?>
                <?php echo '<input type="hidden" name="quizId" value="' . $round[0]['quizId'] . '">'; ?>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2"></div>
                    <input type="submit" class="btn btn-primary pull-right" value="Редактирай"/>
                </div>
            </fieldset>
        </form>
        </div>
</div>