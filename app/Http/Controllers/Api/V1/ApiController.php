<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Helper\ResponseBuilder;
use Illuminate\Http\Request;
use Auth;


class ApiController extends Controller
{

    public function blogPosts(Request $request)
    {
        try {

            $blogs = [
                [
                    'title' => 'Understanding Male Infertility: Symptoms, Remedies, and Next Steps',
                    'image_url' => 'https://diagnomitra.com/wp-content/uploads/2024/02/MI.png',
                    'url' => 'https://diagnomitra.com/understanding-male-infertility-symptoms-remedies-and-next-steps/'
                ],
                [
                    'title' => 'Understanding STDs: Symptoms, Remedies, and Precautions',
                    'image_url' => 'https://diagnomitra.com/wp-content/uploads/2024/02/STDS.png',
                    'url' => 'https://diagnomitra.com/understanding-stds-symptoms-remedies-and-precautions/'
                ],
                [
                    'title' => 'Understanding PCOS/PCOD: Symptoms, Home Remedies, and Lifestyle Management',
                    'image_url' => 'https://diagnomitra.com/wp-content/uploads/2024/02/PCOD.png',
                    'url' => 'https://diagnomitra.com/understanding-pcos-pcod-symptoms-home-remedies-and-lifestyle-management/'
                ]
            ];
            $this->response->blog_data = $blogs;
            return ResponseBuilder::success($this->response, 'Blog list');
        }
        catch (exception $e) {
            return ResponseBuilder::error( __($e->getMessage()), $this->serverError);
        }
    }
}
