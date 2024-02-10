<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->catModel = new \App\Models\ProductsCategoryModel();
        $this->prodModel = new \App\Models\ProductsModel();
        $this->custModel = new \App\Models\CustomerModel();
    }
    public function products()
    {
        $postdata = $this->request->getPost();
        $data['category'] = $this->catModel->findall();
        $data['products'] = $this->prodModel->findall();
        if ($postdata) {
            if (array_key_exists('cat', $postdata)) {
                unset($postdata['cat']);
                $postdata['status'] = 1;
                $this->catModel->insert($postdata);
            } elseif (array_key_exists('prod', $postdata)) {
                unset($postdata['prod']);
                $postdata['status'] = 1;
                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[userfile]',
                            'is_image[userfile]',
                            'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                            'max_size[userfile,100]',
                            'max_dims[userfile,1024,768]',
                        ],
                    ],
                ];
                if (!$this->validate($validationRule)) {
                    $data = ['errors' => $this->validator->getErrors()];
                }

                $img = $this->request->getFile('product_img');

                if (!$img->hasMoved()) {
                    $filepath =  '/uploads/' . $img->store();
                }
                $postdata['product_img'] = $filepath;
                $this->prodModel->Save($postdata);
            } elseif (array_key_exists('prod_edit', $postdata)) {
                unset($postdata['prod_edit']);
                $validationRule = [
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => [
                            'uploaded[product_img]',
                            'is_image[product_img]',
                            'mime_in[product_img,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                            'max_size[product_img,100]',
                            'max_dims[product_img,1024,768]',
                        ],
                    ],
                ];
                if (!$this->validate($validationRule)) {
                    $data = ['errors' => $this->validator->getErrors()];
                }

                $img = $this->request->getFile('product_img');

                if (!$img->hasMoved()) {
                    $filepath =   '/uploads/' . $img->store();
                }
                $postdata['product_img'] = $filepath;
                $this->prodModel->Save($postdata);
            } elseif (array_key_exists('prod_status', $postdata)) {
                unset($postdata['prod_status']);
                $this->prodModel->Save($postdata);
            } elseif (array_key_exists('prod_delete', $postdata)) {
                unset($postdata['prod_delete']);
                $this->prodModel->delete($postdata);
            }

            return redirect()->route('/');
        } else {
            return $this->render_page('products', $data);
        }
    }

    public function customers()
    {
        $postdata = $this->request->getPost();
        $data['customers'] =  $this->custModel->findAll();
        if ($postdata) {
            if (isset($postdata['delete_cust'])) {
                $this->custModel->delete($postdata['id']);
                return redirect()->route('customers');
            } else {
                $postdata['status'] = 1;
                $this->custModel->save($postdata);
                return redirect()->route('customers');
            }
        }
        return $this->render_page('customers', $data);
    }
    public function users()
    {
        $postdata = $this->request->getPost();
        $user_model = new UserModel();
        $data['users'] = $user_model->findAll();
        if ($postdata) {
            $users = auth()->getProvider();

            if (isset($postdata['edit_user'])) {
                $user = $users->findById($postdata['id']);
                $user->fill([
                    'username' => $postdata['name'],
                    'email' => $postdata['email'],
                    'password' => 'pass123456'
                ]);
            } else {
                $user = new User([
                    'username' => $postdata['name'],
                    'email'    => $postdata['email'],
                    'password' => $postdata['password'],
                ]);
            }
            $users->save($user);
            $user = $users->findById($users->getInsertID());
            $users->addToDefaultGroup($user);
            return redirect()->route('users');
        }
        return $this->render_page('users', $data);
    }
}
