<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="well bs-component">
        <form method="POST" class="form-horizontal">
            <fieldset>
                <!--echo '<p>';
                echo		'Куизмастъри: <input type="text" id="quizMaster" name="quizMaster" value="'. $teams[0]['TeamName'] . '" />';
                echo '</p>'-->
                <legend>Създай нов куиз</legend>
                <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Куиз мастър: </label>
                    <div class="col-lg-10">
                        <select class="form-control" id="select" name="teamId">
                            <?php foreach ($teams as $team):?>
                                {
                                <option value="<?php echo $team['TeamId'] ?>" name="<?php echo $team['TeamId'] ?>"><?php echo $team['TeamName'] ?></option>
                                }
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="datepicker" class="col-lg-2 control-label">Дата: </label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="datepicker" name="date" />
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $q['id']?>" />
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2"></div>
                    <input type="submit" class="btn btn-primary pull-right" value="Създай"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>