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



        $this->seedQuestions('Tutor', $this->tutorQuestions());
        $this->seedQuestions('Electrician', $this->electricianQuestions());
        $this->seedQuestions('Plumber', $this->plumberQuestions());
        $this->seedQuestions('Mechanic', $this->mechanicQuestions());
        $this->seedQuestions('Photography', $this->photographyQuestions());
        $this->seedQuestions('Home Cleaning', $this->homeCleaningQuestions());


    }


    public function seedQuestions($service_name, $questions){
        $service = Service::where('name', $service_name)->first();
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

    public function tutorQuestions(){
        return  [
            
                [
                        'question' => 'For which Term are you looking for?',
                        'service_provider_question' => 'In which term will you provide tutor’s service? ',
                        'type' => 'Checkbox',
                        'question_number' => 1,
                        'answers' => [
                            [ 'answer' => 'Montessori Term' ],
                            [ 'answer' => 'Primary Term' ],
                            [ 'answer' => 'Middle Term' ],
                            [ 'answer' => 'Matric/O-levels Term' ],
                            [ 'answer' => 'Intermediate/A-Levels Term ' ],
                            [ 'answer' => 'Bachelors Term' ]
                        ]
                ],
                [
                    'question' => 'For which class are you searching a Montessori tutor?',
                    'service_provider_question' => 'How many classes would you deal in Montessori’s tutor                                                                                                                                          services',
                    'type' => 'Checkbox',
                    'question_number' => 2,
                    'answers' => [
                        [ 'answer' => 'For Playgroup' ],
                        [ 'answer' => 'For Nursery' ],
                        [ 'answer' => 'For prep' ],
                        [ 'answer' => 'For 1 to 4' ],
                            [ 'answer' => 'None of these' ]
                    ]
                ],
                  [
                    'question' => 'For which Subjects are you searching a matric’s tutor?',
                    'service_provider_question' => 'How many subjects would you deal in matric’s tutor                                                                                                                                               services',
                    'type' => 'Checkbox',
                    'question_number' => 3,
                    'answers' => [
                        [ 'answer' => 'Arts Subjects' ],
                        [ 'answer' => 'Physics' ],
                        [ 'answer' => 'Chemistry' ],
                        [ 'answer' => 'Computer Science' ],
                            [ 'answer' => 'Biology' ],
                            [ 'answer' => 'Common subjects' ],
                            [ 'answer' => 'None of these' ]
                    ]
                ],
                [
                    'question' => 'For which Subjects are you searching a intermediate’s tutor?',
                    'service_provider_question' => 'How many subjects would you deal in intermediate’s tutor                                                                                                                                               services',
                    'type' => 'Checkbox',
                    'question_number' => 4,
                    'answers' => [
                        [ 'answer' => 'F.A(Arts)' ],
                        [ 'answer' => 'I.Com' ],
                        [ 'answer' => 'I.CS' ],
                        [ 'answer' => 'F.SC (pre-med)' ],
                            [ 'answer' => 'F.SC (pre-eng)' ],
                            [ 'answer' => 'Biology' ],
                            [ 'answer' => 'None of these' ]
                    ]
                ],

                [
                    'question' => 'For how long do you need a tutor?',
                    'service_provider_question' => 'how many months do you want to teach’?',
                    'type' => 'Checkbox',
                    'question_number' => 5,
                    'answers' => [
                        [ 'answer' => '1-2 months' ],
                        [ 'answer' => '3-5 months' ],
                            [ 'answer' => '7-9 months' ],
                        [ 'answer' => '12 months' ],
                        [ 'answer' => 'Above 1 year' ],
                    ]
                 ],

                [
                    'question' => 'How much you are willing to spend?',
                    'service_provider_question' => 'How much would you like to take ?',
                    'type' => 'Checkbox',
                    'question_number' => 6,
                    'answers' => [
                        [ 'answer' => 'Rs3000 - Rs5000' ],
                        [ 'answer' => 'Rs6000 - Rs7000' ],
                        [ 'answer' => 'Rs8000 - Rs9000' ],
                        [ 'answer' => 'Rs10,000 - Rs11,000' ],
                            [ 'answer' => 'custom charges']
                    ]
                ],
                [
                    'question' => 'For how many hours do you need a tutor?',
                    'service_provider_question' => 'How many hours would you like to teach?',
                    'type' => 'Checkbox',
                    'question_number' => 7,
                    'answers' => [
                        [ 'answer' => '1hrs – 2hrs' ],
                        [ 'answer' => '2hrs - 3hrs' ],
                        [ 'answer' => 'Above 4hrs'  ],
                        [ 'answer' => 'depend on task' ],
                    ]     
                ],
                [
                    'question' => 'Which Gender you perfer?',
                    'service_provider_question' => 'what is your gender?',
                    'type' => 'Checkbox',
                    'question_number' => 8,
                    'answers' => [
                        [ 'answer' => 'Male' ],
                        [ 'answer' => 'Female' ],
                    ]
                ],
                [
                    'question' => 'Teacher should have atleast',
                    'service_provider_question' => 'what is your qualification?',
                    'type' => 'Checkbox',
                    'question_number' => 9,
                    'answers' => [
                        [ 'answer' => 'High School Degree' ],
                        [ 'answer' => 'College Degree' ],
                        [ 'answer' => 'Bachelor Degree' ],
                        [ 'answer' => 'Masters Degree' ]
                    ]
                
                ],
                [
                    'question' => 'Which Time is suitable for you?',
                    'service_provider_question' => 'which time will you available?',
                    'type' => 'Checkbox',
                    'question_number' => 10,
                    'answers' => [
                        [ 'answer' => '1pm - 3pm' ], 
                            [ 'answer' => '4pm -  5pm' ],
                        [ 'answer' => '6pm -  7pm' ],
                        [ 'answer' => '8pm - 9pm' ],
                            [ 'answer' => 'custom Time' ],
                        
                    ]
                ]
       ];
    }


    public function electricianQuestions(){
        return [
                [
                    'question' => 'For which Electrician service are you looking for?',
                    'service_provider_question' => 'Which Electrician service will you provide?',
                    'type' => 'Checkbox',
                    'question_number' => 11,
                    'answers' => [
                        [ 'answer' => 'Repair & Fixes' ],
                        [ 'answer' => 'Installation Services' ],
                        [ 'answer' => 'Electrical Wiring' ],
                        [ 'answer' => 'Electrical Replacement' ],
                        [ 'answer' => 'Electricity Breakdown ' ]
                    ]
                ],
                [
                    'question' => 'which type of installation’s problem are you facing?',
                    'service_provider_question' => 'which type of installation’s problem will you solve?',    
                    'type' => 'Checkbox',
                    'question_number' => 12,

                    'answers' => [	
                        [ 'answer' => 'Fan Installation' ],
                        [ 'answer' => 'Tube light / Bulb / LED installation' ],
                        [ 'answer' => 'Fuse box Installation' ],
                        [ 'answer' => 'Circuit Breaker Panel Installation' ],
                        [ 'answer' => 'None of these' ]
                    ]
                ], 
                [
                          'question' => 'which type of wiring’s problem are you facing?',    
                           'service_provider_question' => 'which type of wiring’s problem will you solve?',
                           'type' => 'Checkbox',
                           'question_number' => 13,
                           'answers' => [
                               [ 'answer' => 'Socket / Switch wiring' ],
                               [ 'answer' => 'circuit breaker wiring' ],
                               [ 'answer' => 'Internal wiring' ],
                               [ 'answer' => 'Casing Wiring' ],
                               [ 'answer' => 'None of these' ]
                           ]
                ], 
                [
                        'question' => 'which type of Replacement’s problem are you facing?',
                        'service_provider_question' => 'which type of Replacement’s problem will you solve?',           
                       'type' => 'Checkbox',
                       'question_number' => 14,

                           'answers' => [
                               [ 'answer' => 'Socket / Switch Replace' ],
                               [ 'answer' => 'Circuit board Replace' ],
                               [ 'answer' => 'Tube light / Bulb / LED Replace' ],
                               [ 'answer' => 'UPS / Inverter / Stabilizer Replace' ],
                               [ 'answer' => 'None of these' ]
                           ]
               ],
               [
                           'question' => 'which type of Repairing’s problem are you facing?',
                           'service_provider_question' => 'which type of Repairing’s problem will you solve?',
                           'type' => 'Checkbox',
                           'question_number' => 15,
                           'answers' => [
                               [ 'answer' => 'UPS Repair' ],
                               [ 'answer' => 'Generator Repair' ],
                               [ 'answer' => 'Inverter / Stabilizer Repair'],
                               [ 'answer' => ' Heater / Washing Machine/ Refrigerator Repair' ],
                               [ 'answer' => 'None of these' ]
                      ]
               ],
               [
                          'question' => '’Have you not find your specific need , then Select one of these?',
                           'service_provider_question' => 'what would you prefer for finding a typical issue?',
                           'type' => 'Checkbox',
                           'question_number' => 16,
                           'answers' => [
                               [ 'answer' => 'Visit to diagnose Issue' ],
                               [ 'answer' => 'Fault tracing Diagnose' ],
                           ]
                           
                ],
                [
                            'question' => 'What type of Provider do you want to Hire?',
                           'service_provider_question' => 'What type of Experience do you have?',
                           'type' => 'Checkbox',
                           'question_number' => 17,
                           'answers' => [
                               [ 'answer' => 'Novice' ],
                               [ 'answer' => 'Advance' ],
                               [ 'answer' => 'Expert' ],
                               [ 'answer' => 'Professional' ]
                            ]
                ],         
                [
                            'question' => 'How many hours would you like to Book?',
                            'service_provider_question' => 'How many hours would you like to Work?',
                            'type' => 'Checkbox',
                            'question_number' => 18,
                            'answers' => [
                               [ 'answer' => '1-2 hours' ],
                               [ 'answer' => '2-4 hours' ],
                               [ 'answer' => '4-6 hours' ],
                               [ 'answer' => '8 hours' ],
                               [ 'answer' => 'Depend on work' ]
                          ]
                 ]
            ];       
    }

    public function plumberQuestions(){
        return [            
                    [
                        'question' => 'For which Plumber service are you looking for?',
                        'service_provider_question' => 'For which Plumber service will you provide?',
                        'type' => 'Checkbox',
                        'question_number' => 19,
                        'answers' => [
                            [ 'answer' => 'Pipe & Tap Fitting' ],
                            [ 'answer' => 'Water Leakage' ],
                            [ 'answer' => 'Repair and Fixes' ],
                            [ 'answer' => 'Installation Services' ],
                        ]
                    ],
                    [
                         'question' => 'For which installation’s service are you looking for?',
                          'service_provider_question' => 'which type of installation’s problem will you solve?',    
                           'type' => 'Checkbox',
                           'question_number' => 20,
                           'answers' => [
                               [ 'answer' => 'Toilet Installation'],
                               [ 'answer' => 'Overhead Tank Installation' ],
                               [ 'answer' => 'Motor Installation' ],
                               [ 'answer' => 'Water Meter Installation' ],
                                [ 'answer' => 'None of these' ],
                           ]
                    ], 
                    [
                          'question' => 'For which Leakage’s service are you looking for?',
                           'service_provider_question' => 'For which Leakage’s problem will you solve?',
                           'type' => 'Checkbox',
                           'question_number' => 21,
                           'answers' => [
                               [ 'answer' => 'Pipe Leakage' ],
                               [ 'answer' => 'Sink / Basin / Shower Leakage' ],
                               [ 'answer' => 'Water Tank Leakage' ],
                               [ 'answer' => 'Underground Leakage' ],
                                [ 'answer' => 'None of these' ],
                       ]
                    ],  
                    [
                            'question' => 'For which Fitting’s service are you looking for?',
                             'service_provider_question' => 'For which Fitting’s problem will you solve?',           
                            'type' => 'Checkbox',
                            'question_number' => 22,
                            'answers' => [
                                [ 'answer' => 'Bath-Tub Fitting' ],
                                [ 'answer' => 'Sink / Basin Fitting' ],
                                [ 'answer' => 'Water Tank Fitting' ],
                                [ 'answer' => 'Shower Fitting' ],
                                [ 'answer' => 'None of these' ],   
                           ]
                   ],
                   [
                            'question' => 'For which Repair’s service are you looking for?',
                           'service_provider_question' => 'For which Repair’s problem will you solve?',
                            'type' => 'Checkbox',
                            'question_number' => 23,
                            'answers' => [
                                [ 'answer' => 'Flush Tank / Bath-Tub Repair' ],
                                [ 'answer' => 'Sink / Basin Repair' ],
                                [ 'answer' => 'Water Tank Repair' ],
                                [ 'answer' => 'Shower Repair' ],
                                [ 'answer' => 'None of these' ]
                           ]
                   ],
                   [
                          'question' => '’Have you not find your specific need , then Select one of these?',
                           'service_provider_question' => 'will you prefer to visiting for finding a specific issue?',
                           'type' => 'Checkbox',
                           'question_number' => 24,
                           'answers' => [
                                [ 'answer' => 'Visit to diagnose Issue' ],
                                [ 'answer' => 'Fault tracing Diagnose' ],
                            ]
                    ],
                    [
                            'question' => 'What type of Provider do you want to Hire?',
                            'service_provider_question' => 'What type of Experience do you have?',
                            'type' => 'Checkbox',
                            'question_number' => 25,
                            'answers' => [
                                [ 'answer' => 'Novice' ],
                                [ 'answer' => 'Advance' ],
                                [ 'answer' => 'Expert' ],
                                [ 'answer' => 'Professional' ]
                            ]
                    ],        
                    [
                            'question' => 'How many hours would you like to Book?',
                            'service_provider_question' => 'How many hours would you like to Work?',
                            'type' => 'Checkbox',
                            'question_number' => 26,
                           'answers' => [
                               [ 'answer' => '1-2 hours' ],
                               [ 'answer' => '2-4 hours' ],
                               [ 'answer' => '4-6 hours' ],
                               [ 'answer' => '8 hours' ],
                               [ 'answer' => 'Depend on work' ]
                          ]
                    ]
            ];
           
    }


    public function mechanicQuestions(){
        return [            
                    [
                            'question' => 'For which Mechanic’s Vehicle are you looking for?',
                            'service_provider_question' => 'In which Mechanic’s Vehicle do you want work?',
                            'type' => 'Checkbox',
                            'question_number' => 27,
                            'answers' => [
                               [ 'answer' => 'For Bike' ],
                               [ 'answer' => 'For Car' ],
                               [ 'answer' => 'For Heavy Vehicles' ],
                               [ 'answer' => 'For Other Vehicles' ],
                           ]
                    ],
                    [
                        'question' => 'For which mechanic’s service are you looking for?',
                        'service_provider_question' => 'For which mechanic’s service will you provide?',   
                        'type' => 'Checkbox',
                        'question_number' => 28,
                        'answers' => [
                               [ 'answer' => 'Replacement'],
                               [ 'answer' => 'Installation' ],
                               [ 'answer' => 'Repair & Fixes' ],
                           ]
                    ], 
                    [
                          'question' => 'For which Replacement’s service are you looking for?',
                           'service_provider_question' => 'For which Replacement’s service will you provide?',
                           'type' => 'Checkbox',
                           'question_number' => 29,
                           'answers' => [
                               [ 'answer' => 'Oil Replacement' ],
                               [ 'answer' => 'Radiator Replacement' ],
                               [ 'answer' => 'Gasket Replacement' ],
                               [ 'answer' => 'Clutch & Plates Replacement' ],
                                 [ 'answer' => 'None of these' ],
                           ]
                    ], 
                    [
                            'question' => 'For which Repair’s service are you looking for?',
                            'service_provider_question' => 'For which Repair’s service would you provide?',
                            'type' => 'Checkbox',
                            'question_number' => 30,
                            'answers' => [
                                [ 'answer' => 'Head Repairing' ],
                               [ 'answer' => 'Gear Box Repairing' ],
                               [ 'answer' => 'Axles / Suspension Repairing' ],
                               [ 'answer' => 'Steeting Repairing' ],
                                [ 'answer' => 'Seals / Packing Leak Repairing' ],
                                [ 'answer' => 'None of these' ],           
                           ]
                   ],
                   [
                            'question' => 'Select any other services regarding to your problem and need',
                            'service_provider_question' => 'Do you want to Select any other services regarding to customer’s problem and need ',
                           'type' => 'Checkbox',
                           'question_number' => 31,
                           'answers' => [
                               [ 'answer' => 'Basic tuning' ],
                               [ 'answer' => 'Computerized tuning' ],
                               [ 'answer' => 'Power Tuning' ],
                               [ 'answer' => 'Brake installation' ],
                                [ 'answer' => 'Engine overhauling' ],
                               [ 'answer' => 'Chain Sprocket' ],
                                 [ 'answer' => 'General Inspection' ],
                               [ 'answer' => 'None of these' ],
                           ]
                   ],
                   [
                          'question' => '’Have you not find your specific need , then Select one of these?',
                           'service_provider_question' => 'will you prefer to visiting for finding a specific issue?',
                           'type' => 'Checkbox',
                           'question_number' => 32,
                           'answers' => [
                               [ 'answer' => 'Visit to diagnose Issue' ],
                               [ 'answer' => 'Fault tracing Diagnose' ],
                            ]               
                    ],
                    [
                            'question' => 'What type of Provider do you want to Hire?',
                            'service_provider_question' => 'What type of Experience do you have?',
                            'type' => 'Checkbox',
                            'question_number' => 33,
                            'answers' => [
                                [ 'answer' => 'Novice' ],
                                [ 'answer' => 'Advance' ],
                                [ 'answer' => 'Expert' ],
                                [ 'answer' => 'Professional']
                            ]
                    ],       
                    [
                            'question' => 'How many hours would you like to Book?',
                            'service_provider_question' => 'How many hours would you like to Work?',
                            'type' => 'Checkbox',
                            'question_number' => 34,
                            'answers' => [
                                [ 'answer' => '1-2 hours' ],
                                [ 'answer' => '2-4 hours' ],
                                [ 'answer' => '4-6 hours' ],
                                [ 'answer' => '8 hours' ],
                                [ 'answer' => 'Depend on work' ]
                        ]
                    ],
                    [
                            'question' => 'From what approximate location would you like to Book?',
                            'service_provider_question' => 'From what approximate location would you like to Book?',
                            'type' => 'Checkbox',
                            'question_number' => 35,
                           'answers' => [
                               [ 'answer' => 'within 5 km' ],
                               [ 'answer' => 'within 10 km' ],
                               [ 'answer' => 'within 15 km' ],
                               [ 'answer' => 'within 20 km' ],
                               [ 'answer' => 'Above 20' ]
                           ]           
                    ],
        ];           
    }


    public function photographyQuestions(){
        return [
                [
                    'question' => 'For which type of Photography do you want?',
                    'service_provider_question' => 'For which type of Photography do you Provide?',
                     'type' => 'Checkbox',
                     'question_number' => 36,
                     'answers' => [
                        [ 'answer' => 'Standard Photography' ],
                        [ 'answer' => 'Aerial Photography' ],
                        [ 'answer' => 'Event Photography' ],
                        [ 'answer' => 'Portrait Photography ' ],
                         [ 'answer' => 'Wedding & fashion Photography ' ],
                    ]
                ],
                [
                        'question' => 'For which photography’s service are you looking for?',
                        'service_provider_question' => 'For which photography’s service will you provide?',
                        'type' => 'Checkbox',    
                        'question_number' => 37,
                        'answers' => [
                            [ 'answer' => 'Bridal Shoot'],
                            [ 'answer' => 'Model Shoot' ],
                            [ 'answer' => 'Family Shoot' ],
                            [ 'answer' => 'Couple Shoot' ],     
                            [ 'answer' => 'Outdoor Shoot' ],      
                            [ 'answer' => 'Product Shoot' ],   
                        ]
                ],
                [
                            'question' => 'For which photography shoot’s service are you looking for?',
                            'service_provider_question' => 'For which photography shoot’s service will you provide?',
                            'type' => 'Checkbox',            
                            'question_number' => 38,
                            'answers' => [
                                [ 'answer' => 'Basic Album' ],
                                [ 'answer' => 'Digital Album' ],
                                [ 'answer' => 'Signature Style Album' ],
                                [ 'answer' => 'Exclusive Family Styled Album' ],
                                [ 'answer' => 'None of these' ],    
                            ]
                ],
                [
                        'question' => 'how much digital photos do you want?',
                        'service_provider_question' => 'how much digital photos do you provide?',
                        'type' => 'Checkbox', 
                        'question_number' => 39,
                        'answers' => [
                            [ 'answer' => 'Unlimited digital photos' ],
                            [ 'answer' => '20 digital edited photos' ],
                            [ 'answer' => '50 digital edited photos' ],
                            [ 'answer' => 'Above 50 digital edited photos'],
                            [ 'answer' => 'None of these' ],        
                        ]
                ],
                [
                        'question' => 'What type of Photographer do you want to Hire?',
                        'service_provider_question' => 'What kind of photographer are you?',
                        'type' => 'Checkbox',
                        'question_number' => 40,
                        'answers' => [
                            [ 'answer' => 'Event Photographer' ],
                            [ 'answer' => 'Product Photographer' ],
                            [ 'answer' => 'Fashion Photographer' ],
                            [ 'answer' => 'Professional Photographer'], 
                        ]
                ],        
                [
                        'question' => 'How many days would you like to Book?',
                        'service_provider_question' => 'How many days would you like to work ?',
                        'type' => 'Checkbox',
                        'question_number' => 41,
                        'answers' => [
                            [ 'answer' => '1 day' ],
                            [ 'answer' => '2 days' ],
                            [ 'answer' => '3 days' ],
                            [ 'answer' => 'Depend on work' ]
                        ]
                ],
        ];
    }

    public function homeCleaningQuestions(){
        return [            
                [
                    'question' => 'For which Home Cleaning service are you looking for?',
                    'service_provider_question' => 'which Home Cleaning service will you provide?',
                    'type' => 'Checkbox',    
                    'question_number' => 42,
                    'answers' => [
                        [ 'answer' => 'Deep Cleaning' ],
                        [ 'answer' => 'Room Cleaning ' ],
                        [ 'answer' => 'Office Cleaning' ],
                        [ 'answer' => 'Full House Cleaning' ],      
                    ]
                ],
                [
                     'question' => 'For which cleaning’s service are you looking for?',
                    'service_provider_question' => 'which cleaning’s service will you provide?',    
                     'type' => 'Checkbox',    
                     'question_number' => 43,
                     'answers' => [
                        [ 'answer' => 'Window cleaning'],
                        [ 'answer' => 'Sofa cleaning' ],
                        [ 'answer' => 'Roof cleaning' ],
                        [ 'answer' => 'Carpet Cleaning' ],
                        [ 'answer' => 'Laundry' ],
                        [ 'answer' => 'None of these' ],
                    ]
                ],
                [
                    'question' => 'how many floors do you want for full house cleaning',
                    'service_provider_question' => 'how many floors do you want to provide service for house cleaning',
                    'type' => 'Checkbox',
                    'question_number' => 44,
                    'answers' => [
                        [ 'answer' => 'one floor' ],
                        [ 'answer' => 'Two floors' ],
                        [ 'answer' => 'Three floors' ],
                        [ 'answer' => 'Complete house' ],
                        [ 'answer' => 'None of these' ],
                    ]
                ],
                [
                    'question' => 'For which Deep cleaning’s service are you looking for?',
                    'service_provider_question' => 'For which Deep cleaning’s service will you provide?',    
                    'type' => 'Checkbox',    
                    'question_number' => 45,
                    'answers' => [
                        [ 'answer' => '1 Bedroom with hall and kitchen' ],
                        [ 'answer' => '2 Bedroom with hall and kitchen'],
                        [ 'answer' => '3 Bedroom with hall and kitchen' ],
                        [ 'answer' => 'Kitchen ,  Bathroom ,  Washroom' ],
                        [ 'answer' => 'None of these' ],
                    ]
                ],
                [
                    'question' => 'How many hours would you like to Book?',
                    'service_provider_question' => 'How many hours would you like to work?',
                    'type' => 'Checkbox',
                    'question_number' => 46,
                    'answers' => [
                        [ 'answer' => '1-2 hours' ],
                        [ 'answer' => '2-4 hours' ],
                        [ 'answer' => '4-6 hours' ],
                        [ 'answer' => '8 hours' ],
                        [ 'answer' => 'Depend on work' ]
                    ]
                ]
        ];    
    }

}
