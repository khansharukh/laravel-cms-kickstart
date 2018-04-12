<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminController extends Controller {
    public function getAdminLogin() {
        if(Session::get('admin_array')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function authUser(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        $where = [
            'email' => $email,
            'password' => hash('sha512', $password)
        ];
        if($this->checkExist('admin', $where)) {
            $wheres = [
                ['email', '=', $email],
                ['password', '=', hash('sha512', $password)],
            ];
            $user = $this->selectFunction('admin', array('id', 'name', 'email'), $wheres);
            Session::put('admin_array', $user);
            Session::put('admin_array_json', json_encode($user));

            return redirect()->route('admin.dashboard')->with('user_log', 'Admin was logged in successfully');
        } else {
            return redirect()->route('admin.login')->with('user_error', 'Invalid credentials');
        }
    }
    public function getAdminLogout() {
        Session::forget('admin_array');
        Session::forget('admin_array_json');
        return redirect()->route('admin.login');
    }
    public function getDashboard() {
        return view('admin.dashboard');
    }
    public function getCategories() {
        $data = $this->selectFunction('categories', array('id', 'title', 'image'), '');
        return view('admin.pages.category.category')->with('categories', $data);
    }
    public function addCategories() {
        return view('admin.pages.category.category-form');
    }
    public function insertCategories(Request $request) {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->file('image');
        $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/category');
        $imageName->move($destinationPath, $input['imageName']);

        $data = [
            'title' => $request->get('title'),
            'image' => $input['imageName'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('categories', $data);

        return redirect()->route('admin.category')->with('message', 'Category created successfully');
    }
    public function editCategories($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('categories', array('id', 'title', 'image'), $wheres);
        return view('admin.pages.category.category-form')->with('category', $data);
    }
    public function updateCategories(Request $request) {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(!empty($request->file('image'))) {
            //delete and insert/upload new file
            $filename = $request->get('e_file');
            File::delete(public_path().'/uploads/category/'.$filename);

            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = $request->file('image');
            $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category');
            $imageName->move($destinationPath, $input['imageName']);

            $data = [
                'title' => $request->get('title'),
                'image' => $input['imageName'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'title' => $request->get('title'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->updateFunction('categories', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.category')->with('message', 'Category updated successfully');
    }
    public function deleteCategories(Request $request) {
        $id = $request->get('_id');
        $filename = $request->get('file');
        File::delete(public_path().'/uploads/category/'.$filename);
        $this->deleteFunction('categories', 'id', $id);
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully');
    }
    public function getSubCategories() {
        $data = $this->selectFunction('sub_categories', array('id', 's_title', 's_image', 'cat_id'), '');
        return view('admin.pages.sub-category.category')->with('categories', $data);
    }
    public function addSubCategories() {
        $data = $this->selectFunction('categories', array('id', 'title'), '');
        return view('admin.pages.sub-category.category-form')->with('categories', $data);
    }
    public function insertSubCategories(Request $request) {
        $this->validate($request, [
            'cat_id' => 'required',
            's_title' => 'required',
        ]);
        $this->validate($request, [
            's_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->file('s_image');
        $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/sub-category');
        $imageName->move($destinationPath, $input['imageName']);

        $data = [
            'cat_id' => $request->get('cat_id'),
            's_title' => $request->get('s_title'),
            's_image' => $input['imageName'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('sub_categories', $data);

        return redirect()->route('admin.sub_category')->with('message', 'Category created successfully');
    }
    public function editSubCategories($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('sub_categories', array('id', 'cat_id', 's_title', 's_image'), $wheres);
        $data2 = $this->selectFunction('categories', array('id', 'title'), '');
        return view('admin.pages.sub-category.category-form')->with('category', $data)->with('categories', $data2);
    }
    public function updateSubCategories(Request $request) {
        $this->validate($request, [
            'cat_id' => 'required',
            's_title' => 'required',
        ]);
        $this->validate($request, [
            's_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(!empty($request->file('s_image'))) {
            //delete and insert/upload new file
            $filename = $request->get('e_file');
            File::delete(public_path().'/uploads/sub-category/'.$filename);

            $imageName = $request->file('s_image');
            $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/sub-category');
            $imageName->move($destinationPath, $input['imageName']);

            $data = [
                'cat_id' => $request->get('cat_id'),
                's_title' => $request->get('s_title'),
                's_image' => $input['imageName'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                's_title' => $request->get('s_title'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->updateFunction('sub_categories', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.sub_category')->with('message', 'Sub-Category updated successfully');
    }
    public function deleteSubCategories(Request $request) {
        $id = $request->get('_id');
        $filename = $request->get('file');
        File::delete(public_path().'/uploads/sub-category/'.$filename);
        $this->deleteFunction('sub_categories', 'id', $id);
        return redirect()->route('admin.sub_category')->with('success', 'Sub-Category deleted successfully');
    }
    public function getUnit() {
        $data = $this->selectFunction('units', array('id', 'title'), '');
        return view('admin.pages.unit.unit')->with('units', $data);
    }
    public function actionUnit(Request $request) {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $data = [
            'title' => $request->get('title'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        if($request->get('_id')) {
            $this->updateFunction('units', $data, 'id', $request->get('_id'));
        } else {
            $this->insertFunction('units', $data);
        }
        return redirect()->route('admin.unit')->with('message', 'Unit added successfully');
    }
    public function deleteUnit(Request $request) {
        $id = $request->get('_id');
        $this->deleteFunction('units', 'id', $id);
        return redirect()->route('admin.unit')->with('success', 'Unit deleted successfully');
    }
    public function getGrade() {
        $data = $this->selectFunction('grades', array('id', 'title'), '');
        return view('admin.pages.grade.grade')->with('grades', $data);
    }
    public function actionGrade(Request $request) {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $data = [
            'title' => $request->get('title'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        if($request->get('_id')) {
            $this->updateFunction('grades', $data, 'id', $request->get('_id'));
        } else {
            $this->insertFunction('grades', $data);
        }
        return redirect()->route('admin.grade')->with('message', 'Grade added successfully');
    }
    public function deleteGrade(Request $request) {
        $id = $request->get('_id');
        $this->deleteFunction('grades', 'id', $id);
        return redirect()->route('admin.grade')->with('success', 'Grade deleted successfully');
    }
    public function getPackage() {
        $data = $this->selectFunction('packagings', array('id', 'title'), '');
        return view('admin.pages.package.package')->with('packages', $data);
    }
    public function actionPackage(Request $request) {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $data = [
            'title' => $request->get('title'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        if($request->get('_id')) {
            $this->updateFunction('packagings', $data, 'id', $request->get('_id'));
        } else {
            $this->insertFunction('packagings', $data);
        }
        return redirect()->route('admin.package')->with('message', 'Package added successfully');
    }
    public function deletePackage(Request $request) {
        $id = $request->get('_id');
        $this->deleteFunction('packagings', 'id', $id);
        return redirect()->route('admin.package')->with('success', 'Package deleted successfully');
    }
    public function getAbout() {
        $data = $this->selectFunction('about', array('id', 'title', 'file', 'description'), '');
        return view('admin.pages.about.about')->with('abouts', $data);
    }
    public function addAbout() {
        return view('admin.pages.about.about-form');
    }
    public function insertAbout(Request $request) {
        $this->validate($request, [
            'description' => 'required',
            'title' => 'required',
        ]);
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->file('file');
        $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/about');
        $imageName->move($destinationPath, $input['imageName']);

        $data = [
            'description' => htmlentities($request->get('description')),
            'title' => $request->get('title'),
            'file' => $input['imageName'],
            'status' => $request->get('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('about', $data);

        return redirect()->route('admin.about')->with('message', 'About created successfully');
    }
    public function editAbout($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('about', array('id', 'description', 'title', 'file', 'status'), $wheres);
        return view('admin.pages.about.about-form')->with('about', $data);
    }
    public function updateAbout(Request $request) {
        $this->validate($request, [
            'description' => 'required',
            'title' => 'required',
        ]);
        if(!empty($request->file('file'))) {
            //delete and insert/upload new file
            $filename = $request->get('e_file');
            File::delete(public_path().'/uploads/about/'.$filename);

            $imageName = $request->file('file');
            $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/about');
            $imageName->move($destinationPath, $input['imageName']);

            $data = [
                'description' => htmlentities($request->get('description')),
                'title' => $request->get('title'),
                'file' => $input['imageName'],
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'description' => htmlentities($request->get('description')),
                'title' => $request->get('title'),
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->updateFunction('about', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.about')->with('message', 'About updated successfully');
    }
    public function deleteAbout(Request $request) {
        $id = $request->get('_id');
        $filename = $request->get('file');
        File::delete(public_path().'/uploads/about/'.$filename);
        $this->deleteFunction('about', 'id', $id);
        return redirect()->route('admin.about')->with('success', 'About deleted successfully');
    }
    public function getBanners() {
        $data = $this->selectFunction('banners', array('id', 'cap_title', 'caption', 'link', 'status', 'target', 'filename'), '');
        return view('admin.pages.banner.banner')->with('banners', $data);
    }
    public function addBanner() {
        return view('admin.pages.banner.banner-form');
    }
    public function insertBanner(Request $request) {
        $this->validate($request, [
            'filename' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->file('filename');
        $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/banners');
        $imageName->move($destinationPath, $input['imageName']);

        $data = [
            'filename' => $input['imageName'],
            'cap_title' => $request->get('cap_title'),
            'caption' => $request->get('caption'),
            'link' => $request->get('link'),
            'target' => $request->get('target'),
            'status' => $request->get('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('banners', $data);

        return redirect()->route('admin.banner')->with('message', 'Banner created successfully');
    }
    public function editBanner($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('banners', array('id', 'cap_title', 'caption', 'link', 'status', 'target', 'filename'), $wheres);
        return view('admin.pages.banner.banner-form')->with('banner', $data);
    }
    public function updateBanner(Request $request) {
        if(!empty($request->file('filename'))) {
            //delete and insert/upload new file
            $filename = $request->get('e_file');
            File::delete(public_path().'/uploads/banners/'.$filename);

            $imageName = $request->file('filename');
            $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/banners');
            $imageName->move($destinationPath, $input['imageName']);

            $data = [
                'filename' => $input['imageName'],
                'cap_title' => $request->get('cap_title'),
                'caption' => $request->get('caption'),
                'link' => $request->get('link'),
                'target' => $request->get('target'),
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'cap_title' => $request->get('cap_title'),
                'caption' => $request->get('caption'),
                'link' => $request->get('link'),
                'target' => $request->get('target'),
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->updateFunction('banners', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.banner')->with('message', 'Banner updated successfully');
    }
    public function deleteBanner(Request $request) {
        $id = $request->get('_id');
        $filename = $request->get('file');
        File::delete(public_path().'/uploads/banners/'.$filename);
        $this->deleteFunction('banners', 'id', $id);
        return redirect()->route('admin.banner')->with('success', 'Banner deleted successfully');
    }
    public function getTestimonials() {
        $data = $this->selectFunction('testimonials', array('*'), '');
        return view('admin.pages.testimonials.testimonial')->with('testimonials', $data);
    }
    public function addTestimonial() {
        return view('admin.pages.testimonials.testimonial-form');
    }
    public function insertTestimonial(Request $request) {
        $this->validate($request, [
            'filename' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->file('filename');
        $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/testimonials');
        $imageName->move($destinationPath, $input['imageName']);

        $data = [
            'image' => $input['imageName'],
            'name' => $request->get('name'),
            'comment' => $request->get('comments'),
            'ratings' => $request->get('ratings'),
            'status' => $request->get('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('testimonials', $data);

        return redirect()->route('admin.testimonial')->with('message', 'Testimonial created successfully');
    }
    public function editTestimonial($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('testimonials', array('*'), $wheres);
        return view('admin.pages.testimonials.testimonial-form')->with('testimonial', $data);
    }
    public function updateTestimonial(Request $request) {
        if(!empty($request->file('filename'))) {
            //delete and insert/upload new file
            $filename = $request->get('e_file');
            File::delete(public_path().'/uploads/testimonials/'.$filename);

            $imageName = $request->file('filename');
            $input['imageName'] = time() . '.' . $imageName->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/testimonials');
            $imageName->move($destinationPath, $input['imageName']);

            $data = [
                'image' => $input['imageName'],
                'name' => $request->get('name'),
                'comment' => $request->get('comments'),
                'ratings' => $request->get('ratings'),
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'name' => $request->get('name'),
                'comment' => $request->get('comments'),
                'ratings' => $request->get('ratings'),
                'status' => $request->get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        $this->updateFunction('testimonials', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.testimonial')->with('message', 'Testimonial updated successfully');
    }
    public function deleteTestimonial(Request $request) {
        $id = $request->get('_id');
        $filename = $request->get('file');
        File::delete(public_path().'/uploads/testimonials/'.$filename);
        $this->deleteFunction('testimonials', 'id', $id);
        return redirect()->route('admin.testimonial')->with('success', 'Testimonial deleted successfully');
    }
    public function getAdminProfile() {
        $logged_array = Session::get('admin_array');
        $wheres = [
            'id' => $logged_array[0]->id
        ];
        $data = $this->selectFunction('admin', array('*'), $wheres);
        return view('admin.pages.profile.profile-view')->with('result', $data);
    }
    public function updateAdminProfile(Request $request) {
        $id = $request->get('_id');
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->updateFunction('admin', $data, 'id', $id);

        $data['id'] = $id;
        $data2[] = (object) $data;
        Session::put('admin_array', $data2);
        Session::put('admin_array_json', json_encode($data2));

        return redirect()->route('admin.profile')->with('message', 'Profile updated successfully');
    }
    public function getAdminSettings() {
        return view('admin.pages.profile.settings-view');
    }
    public function updateAdminSettings(Request $request) {
        $id = $request->get('_id');
        $data = [
            'password' => hash('sha512', $request->get('password')),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->updateFunction('admin', $data, 'id', $id);

        return redirect()->route('admin.settings')->with('updated', 'Password updated successfully');
    }
    public function getSuppliers() {
        $wheres = [
            'is_approved' => '0',
            'is_supplier' => '1'
        ];
        $data = $this->selectFunction('users', array('id', 'name', 'email', 'is_approved'), $wheres);
        $wheres = [
            'is_approved' => '1',
            'is_supplier' => '1'
        ];
        $data2 = $this->selectFunction('users', array('id', 'name', 'email', 'is_approved'), $wheres);
        return view('admin.pages.supplier.supplier')->with('suppliers', $data)->with('approved', $data2);
    }
    public function updateSuppliers(Request $request) {
        $data = [
            'is_approved' => '1'
        ];
        $this->updateFunction('users', $data, 'id', $request->get('_id'));
        return redirect()->route('admin.suppliers')->with('message', 'Approval status updated successfully');
    }
    public function getContacts() {
        $data = $this->selectFunction('contacts', array('*'), '');
        return view('admin.pages.contact.contact')->with('contacts', $data);
    }
    public function addContact() {
        return view('admin.pages.contact.contact-form');
    }
    public function insertContact(Request $request) {
        $data = [
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'status' => $request->get('status'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->insertFunction('contacts', $data);

        return redirect()->route('admin.contact')->with('message', 'Contact created successfully');
    }
    public function editContact($id) {
        $wheres = [
            'id' => $id
        ];
        $data = $this->selectFunction('contacts', array('*'), $wheres);
        return view('admin.pages.contact.contact-form')->with('contact', $data);
    }
    public function updateContact(Request $request) {
        $data = [
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'status' => $request->get('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->updateFunction('contacts', $data, 'id', $request->get('_id'));

        return redirect()->route('admin.contact')->with('message', 'Contact updated successfully');
    }
    public function deleteContact(Request $request) {
        $id = $request->get('_id');
        $this->deleteFunction('contacts', 'id', $id);
        return redirect()->route('admin.contact')->with('success', 'Contact deleted successfully');
    }
    public function getSocial() {
        $data = $this->selectFunction('socials', array('*'), '');
        return view('admin.pages.social.social')->with('result', $data);
    }
    public function updateSocial(Request $request) {
        $id = $request->get('_id');
        $data = [
            'twitter' => $request->get('twitter'),
            'facebook' => $request->get('facebook'),
            'google' => $request->get('google'),
            'instagram' => $request->get('instagram'),
            'linkedin' => $request->get('linkedin'),
            'pinterest' => $request->get('pinterest'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if($id) {
            $this->updateFunction('socials', $data, 'id', $id);
        } else {
            $this->insertFunction('socials', $data);
        }

        return redirect()->route('admin.social')->with('updated', 'Social updated successfully');
    }
}
