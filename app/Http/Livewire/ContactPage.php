<?php

namespace App\Http\Livewire;


use App\Models\ContactFormSubmission;
use Livewire\Component;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class ContactPage extends Component
{
    use WithRateLimiting;

    public $name, $email, $phone, $company, $message;


    protected function rules()
    {
        return [

            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required',
            'company' => '',
            'message' => 'required',


        ];
    }

    public function render()
    {
        return view('livewire.contact-page');
    }
    public function mount(Request $request)
    {
        $this->name = $request->user()?->name;
        $this->email = $request->user()?->email;
        $this->phone = $request->user()?->phone;
    }
    public function submit()
    {
        $this->validate();
        try {
            $this->rateLimit(3, 60 * 5);
        } catch (TooManyRequestsException $exception) {
            $time = CarbonInterval::seconds($exception->secondsUntilAvailable)->cascade()->forHumans();
            throw ValidationException::withMessages([

                'message' => "Slow down! Please wait {$time}",
            ]);
        }

        ContactFormSubmission::create($this->validate());

        $this->reset(['message']);
        $this->notify('Contact form Submitted', 'success');
    }
}