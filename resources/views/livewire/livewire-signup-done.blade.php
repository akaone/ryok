<div class="bg-gray-ef h-screen flex flex-col sm:items-center">
    <div class="flex flex-row mx-auto mb-4 mt-8 justify-center">
        <h3 class="font-ryok text-pblue text-2xl self-center">Ryok</h3>
        <span  class="text-pblue text-lg italic self-center ml-1">- {{ trans('signup.done_email') }}</span>
    </div>

    <div class="sm:rounded flex flex-col bg-white sm:shadow-md sm:mx-auto sm:w-10/12 md:w-6/12 lg:w-5/12">

        <div class="flex flex-col p-6 font-light text-xl">
            <span>
                {{ trans('signup.label_left') }}
                <span class="text-pblue italic font-bold">{{ $email }}</span>
            </span>
            <span>
            {{ trans('signup.label_right') }}
            </span>
        </div>

    </div>

</div>