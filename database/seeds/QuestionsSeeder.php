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


        // for tutor
        $questions = [
            [
                'question' => 'For which Subject are you looking for?',
                'service_provider_question' => 'Which subjects you would like to teach?',
                'type' => 'checkbox',
                'answers' => [
                    [ 'answer' => 'Math’s' ],
                    [ 'answer' => 'Physics' ],
                    [ 'answer' => 'Chemistry' ],
                    [ 'answer' => 'English' ],
                    [ 'answer' => 'Computers' ]
                ]
            ],
     		[
                'question' => 'For which class are you searching a math’s tutor?',
                'service_provider_question' => 'Which Class you would like to teach?',
                'type' => 'checkbox',
                'answers' => [
                    [ 'answer' => 'Matric' ],
                    [ 'answer' => 'I.com' ],
                    [ 'answer' => 'Ics' ],
                    [ 'answer' => 'O levels' ]
                ]
            ],
            // [
            //     'question' => 'For how long do you need a tutor?',
            //     'service_provider_question' => 'Which Class you would like to teach?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => '1-2 months' ],
            //         [ 'answer' => '3-5 months' ],
            //     ]
            // ],
            // [
            //     'question' => 'How much you are willing to spend?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => 'Rs3000-Rs5000' ],
            //         [ 'answer' => 'Rs6000-Rs7000' ],
            //         [ 'answer' => 'Rs8000-Rs9000' ],
            //         [ 'answer' => 'Rs10,000-Rs11,000' ]
            //     ]
            // ],
            // [
            //     'question' => 'For how many hours do you need a tutor?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => '1-2' ],
            //         [ 'answer' => '2-3' ],
            //     ]
            // ],
            // [
            //     'question' => 'Which Gender Do you perfer?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => 'Male' ],
            //         [ 'answer' => 'Female' ],
            //     ]
            // ],
            // [
            //     'question' => 'Teacher should have at least',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => 'High School' ],
            //         [ 'answer' => 'College Degree' ],
            //         [ 'answer' => 'Bachelor Degree' ],
            //         [ 'answer' => 'Masters Degree' ]
            //     ]
            // ],
            // [
            //     'question' => 'Which Time is suitable for you?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => '4-5pm' ],
            //         [ 'answer' => '6-7pm' ],
            //         [ 'answer' => '8-9pm' ],
            //     ]
            // ],
            // [
            //     'question' => 'How Should a teacher teach you?',
            //     'type' => 'checkbox',
            //     'answers' => [
            //         [ 'answer' => 'Come to your home' ],
            //         [ 'answer' => 'Online Class' ]
            //     ]
            // ]    
        ];

        $service = Service::where('name', 'Tutor')->first();
        foreach($questions as $question){
            $q = Question::create([
                'question' => $question['question'],
                'service_provider_question' => $question['service_provider_question'],
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
