<?php

use App\Answer;
use App\Question;
use App\Service;
use Illuminate\Database\Seeder;

use function GuzzleHttp\Promise\queue;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();
        Answer::truncate();


        // for maths tutor
        $questions = [
            [
                'question' => 'For which class are you searching a maths tutor?',
                'service_provider_question' =>   'some question',
                'type' => 'checkbox',
                'answers' => [
                    [ 'answer' => 'Matric' ],
                    [ 'answer' => 'icom' ],
                    [ 'answer' => 'ics' ],
                    [ 'answer' => 'O levels' ]
                ]
            ],
            [
                'question' => 'For how many hours do you need a turor?',
                'service_provider_question' =>   'some question',
                'type' => 'checkbox',
                'answers' => [
                    [ 'answer' => '1' ],
                    [ 'answer' => '2' ],
                    [ 'answer' => '3' ],
                    [ 'answer' => '4' ]
                ]
            ]
        ];

        $service = Service::where('name', 'Maths Tutor')->first();
        foreach($questions as $question){
            $q = Question::create([
                'question' => $question['question'],
                'type' => $question['type'],
            ]);
            $q->service()->associate($service);
            $q->save();
            foreach($question['answers'] as $answer){
                $q->answers()->create([
                    'answer' => $answer['answer']
                ]);
            }
        }

    }
}
