<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Send a successful response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data = null, $message = 'Operation successful', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Send an error response.
     *
     * @param string $message
     * @param int $status
     * @param array|null $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = 'Operation failed', $status = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * Send a validation error response.
     *
     * @param array $errors
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function validationErrorResponse(array $errors, $message = 'Validation failed')
    {
        return $this->errorResponse($message, 422, $errors);
    }

    /**
     * Send an unauthorized response.
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorizedResponse($message = 'Unauthorized')
    {
        return $this->errorResponse($message, 401);
    }
}
