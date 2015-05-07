<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="well bs-component">
        <form method="POST" class="form-horizontal">
            <fieldset>
                <legend>Добави нов кръг</legend>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Име: </label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Име на кръга" name="name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">Номер: </label>
                    <div class="col-lg-10">
                        <input type="text" placeholder="Номер на кръга" name="roundNumber" class="form-control"/>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id?>" />
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2"></div>
                    <input type="submit" class="btn btn-primary pull-right" value="Създай"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>