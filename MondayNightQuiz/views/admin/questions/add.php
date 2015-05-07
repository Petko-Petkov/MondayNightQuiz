<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="well bs-component">
        <form method="POST" class="form-horizontal">
            <fieldset>
                <legend>Добвави нов въпрос</legend>
                <div class="form-group">
                    <label for="content" class="col-lg-3 control-label">Съдържание: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Въпрос" name="content" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="number" class="col-lg-3 control-label">Номер: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Номер на въпроса" name="number" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="answer" class="col-lg-3 control-label">Отговор: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Отговор" name="answer" class="form-control"/>
                    </div>
                </div>
                <input type="hidden" name="teamId" value="<?php echo $quiz[0]['TeamId']?>" />
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2"></div>
                    <input type="submit" class="btn btn-primary pull-right" value="Създай"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>