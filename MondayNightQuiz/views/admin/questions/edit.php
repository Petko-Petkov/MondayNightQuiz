<div class="col-lg-3"></div>
<div class="col-lg-6">
    <div class="well bs-component">
        <form method="POST" class="form-horizontal">
            <fieldset>
                <legend>Редактирай въпрос</legend>
                <div class="form-group">
                    <label for="content" class="col-lg-3 control-label">Съдържание: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Въпрос" name="content" class="form-control" value="<?php echo $question[0]['content']?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="number" class="col-lg-3 control-label">Пореден номер: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Номер на въпроса" name="number" class="form-control" value="<?php echo $question[0]['questionNumber']?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="answer" class="col-lg-3 control-label">Отговор: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Отговор" name="answer" class="form-control" value="<?php echo $question[0]['answer']?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="round" class="col-lg-3 control-label">Кръг: </label>
                    <div class="col-lg-9">
                        <input type="text" placeholder="Отговор" name="round" class="form-control" value="<?php echo $question[0]['roundNumber']?>"/>
                    </div>
                </div>
                <input type="hidden" name="quizId" value="<?php echo $question[0]['quizId']?>" />
                <input type="hidden" name="questionId" value="<?php echo $question[0]['questionId']?>" />
                <input type="hidden" name="teamId" value="<?php echo $question[0]['teamId']?>" />
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2"></div>
                    <input type="submit" class="btn btn-primary pull-right" value="Редактирай"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>