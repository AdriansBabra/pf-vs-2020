<h2>Statistics</h2>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>User Answer</th>
        <th>Correct Answer</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($quiz->questions as $question): ?>
        <tr>
            <td><?= $question->id; ?></td>
            <td><?= e($question->title); ?></td>
            <td><?php
                for($i = 0; $i<count($attemptAnswers); $i++){
                    if($attemptAnswers[$i]->attempt_id === $attempt->id && $question->id === $attemptAnswers[$i]->question_id)
                        for($j = 0; $j<count($answers); $j++){
                            if($attemptAnswers[$i]->answer_id === $answers[$j]->id){
                                echo $answers[$j]->title;
                            }
                        }
                }
                ?></td>
            <td><?php
                for($i = 0; $i<count($answers); $i++){
                    if($answers[$i]->question_id === $question->id && $answers[$i]->is_correct){
                        echo $answers[$i]->title;
                    }
                }
                ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>