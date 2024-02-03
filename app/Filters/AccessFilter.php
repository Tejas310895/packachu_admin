<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (auth()->user()) {
            if (!in_array('admin', auth()->user()->getGroups())) {
                return redirect()->route('logout');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
