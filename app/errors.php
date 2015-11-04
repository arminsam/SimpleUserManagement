<?php

/**
 * Handle unauthorized user action globally
 */
App::error(function(ASM\Foundation\Exceptions\UnauthorizedUserActionException $exception, $code)
{
    if (Request::ajax())
    {
        return [
            'error' => [
                'messages' => [$exception->getMessage()]
            ]
        ];
    }

    return is_null(\Request::header('referer'))
        ? Redirect::route('dashboard.index')->withInput()->withErrors([$exception->getMessage()])
        : Redirect::back()->withInput()->withErrors([$exception->getMessage()]);
});

/**
 * Handle all validation errors globally
 */
App::error(function(ASM\Foundation\Exceptions\ValidationFailedException $exception, $code)
{
    if (Request::ajax())
    {
        return [
            'error' => [
                'fields' => $exception->getErrors(),
                'messages' => $exception->getErrors()->all()
            ]
        ];
    }
    // The following line is to prevent errors related serializing objects (UploadedFile object to be exact)
    $inputs = Input::except('inputs');
    return is_null(\Request::header('referer'))
        ? Redirect::route('dashboard.index', [user_company()->code])->withInput($inputs)->withErrors([$exception->getMessage()])
        : Redirect::back()->withInput($inputs)->withErrors($exception->getErrors());
});

/**
 * Handle all invalid login credentials globally
 */
App::error(function(ASM\Foundation\Exceptions\InvalidLoginCredentialsException $exception, $code)
{
    return is_null(\Request::header('referer'))
        ? Redirect::route('dashboard.index')->withInput()->withErrors([$exception->getMessage()])
        : Redirect::back()->withInput()->withErrors([$exception->getMessage()]);
});

/**
 * Handle general exceptions here
 */
App::error(function(Exception $exception, $code)
{
    Log::error($exception);
});