<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/LandownerModel.php';
require_once __DIR__ . '/../models/FarmerModel.php';

class LandownerController
{
    private LandownerModel $landownerModel;
    private FarmerModel   $farmerModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->landownerModel = new LandownerModel($db);
        $this->farmerModel    = new FarmerModel($db);
    }

    public function dashboard(): void
    {
        $userId = Auth::userId();
        $landowner = $this->landownerModel->getProfileByUserId($userId);

        $lands_count = 0;
        $lands_list = [];
        $hiring_count = 0;
        $lease_offers = [];

        if ($landowner) {
            $landownerId = (int)$landowner['id'];
            $lands_count = $this->landownerModel->getLandsCount($landownerId);
            $lands_list = $this->landownerModel->getRecentLands($landownerId, 5);
            $hiring_count = $this->landownerModel->getHiringCount($landownerId);
            $lease_offers = $this->landownerModel->getAcceptedLeaseOffers($landownerId);
        }

        $GLOBALS['_landowner_dashboard_data'] = compact(
            'landowner', 'lands_count', 'lands_list', 'hiring_count', 'lease_offers'
        );
    }


    public function addLand(): void
    {
        $userId = Auth::userId();
        $landowner = $this->landownerModel->getProfileByUserId($userId);

        if (!$landowner) {
            die("Landowner profile not found.");
        }

        $landownerId = (int)$landowner['id'];
        $message = '';
        $message_class = '';
        $title = $location = $area = $soil_type = $land_type = $description = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? $_POST['land_title'] ?? '');
            $location = trim($_POST['location'] ?? '');
            $area = trim($_POST['area'] ?? $_POST['acreage'] ?? '');
            $area_unit = $_POST['area_unit'] ?? 'acre';
            $soil_type = trim($_POST['soil_type'] ?? '');
            $land_type = trim($_POST['land_type'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $availability_status = $_POST['status'] ?? 'available';
            $image_path = null;

            if (empty($title) || empty($location) || empty($area) || empty($area_unit)) {
                $message = "Please fill in all required fields (Land Title, Location, Area, and Unit).";
                $message_class = "error-message";
            } else {
                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_name = basename($_FILES['image']['name']);
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

                    if (in_array($file_ext, $allowed_exts)) {
                        $target_dir = __DIR__ . '/../uploads/lands/';
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        $new_file_name = uniqid('land_', true) . '.' . $file_ext;
                        $target_file = $target_dir . $new_file_name;

                        if (move_uploaded_file($file_tmp, $target_file)) {
                            $image_path = 'uploads/lands/' . $new_file_name;
                        } else {
                            $message = "Failed to upload property image.";
                            $message_class = "error-message";
                        }
                    } else {
                        $message = "Invalid image format. Allowed formats: JPG, JPEG, PNG, WEBP.";
                        $message_class = "error-message";
                    }
                }

                if (empty($message)) {
                    $area_val = floatval($area);
                    $created = $this->landownerModel->addLand(
                        $landownerId, $title, $location, $area_val, $area_unit,
                        $soil_type, $land_type, $description, $image_path, $availability_status
                    );

                    if ($created) {
                        $message = "Land parcel listed successfully!";
                        $message_class = "registration-message";
                        $title = $location = $area = $soil_type = $land_type = $description = '';
                    } else {
                        $message = "Database error: Failed to save land listing.";
                        $message_class = "error-message";
                    }
                }
            }
        }

        $GLOBALS['_landowner_add_land_data'] = compact(
            'message', 'message_class', 'title', 'location', 'area',
            'soil_type', 'land_type', 'description'
        );
    }


    public function manageLand(): void
    {
        $userId = Auth::userId();
        $landowner = $this->landownerModel->getProfileByUserId($userId);

        if (!$landowner) {
            die("Landowner profile not found.");
        }

        $landownerId = (int)$landowner['id'];
        $message = '';
        $message_type = '';
        $edit_land = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_land_id'])) {
            $land_id = intval($_POST['delete_land_id']);
            $land_record = $this->landownerModel->getLandByIdAndOwner($land_id, $landownerId);

            if ($land_record) {
                if (!empty($land_record['image']) && file_exists(__DIR__ . '/../' . $land_record['image'])) {
                    unlink(__DIR__ . '/../' . $land_record['image']);
                }

                if ($this->landownerModel->deleteLand($land_id)) {
                    $message = "Land listing deleted successfully.";
                    $message_type = "success";
                } else {
                    $message = "Error deleting land listing.";
                    $message_type = "error";
                }
            } else {
                $message = "Unauthorized deletion attempt.";
                $message_type = "error";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_land'])) {
            $land_id = intval($_POST['land_id']);
            $title = trim($_POST['title'] ?? '');
            $location = trim($_POST['location'] ?? '');
            $area = trim($_POST['area'] ?? '');
            $area_unit = $_POST['area_unit'] ?? 'acre';
            $soil_type = trim($_POST['soil_type'] ?? '');
            $land_type = trim($_POST['land_type'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $availability_status = $_POST['availability_status'] ?? 'available';

            $existing_land = $this->landownerModel->getLandByIdAndOwner($land_id, $landownerId);

            if ($existing_land) {
                $image_path = $existing_land['image'];

                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_name = basename($_FILES['image']['name']);
                    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

                    if (in_array($file_ext, $allowed_exts)) {
                        $target_dir = __DIR__ . '/../uploads/lands/';
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        $new_file_name = uniqid('land_', true) . '.' . $file_ext;
                        $target_file = $target_dir . $new_file_name;

                        if (move_uploaded_file($file_tmp, $target_file)) {
                            if (!empty($existing_land['image']) && file_exists(__DIR__ . '/../' . $existing_land['image'])) {
                                unlink(__DIR__ . '/../' . $existing_land['image']);
                            }
                            $image_path = 'uploads/lands/' . $new_file_name;
                        }
                    }
                }

                $area_val = floatval($area);
                if ($this->landownerModel->updateLand(
                    $land_id, $title, $location, $area_val, $area_unit,
                    $soil_type, $land_type, $description, $image_path, $availability_status
                )) {
                    $message = "Land listing updated successfully!";
                    $message_type = "success";
                } else {
                    $message = "Failed to update land listing.";
                    $message_type = "error";
                }
            } else {
                $message = "Unauthorized update attempt.";
                $message_type = "error";
            }
        }

        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
            $edit_id = intval($_GET['id']);
            $edit_land = $this->landownerModel->getLandByIdAndOwner($edit_id, $landownerId);
        }

        $all_lands = $this->landownerModel->getLandsByLandownerId($landownerId);

        $total_area = 0;
        $active_leases = 0;
        foreach ($all_lands as $l) {
            $total_area += floatval($l['area']);
            if ($l['availability_status'] === 'leased' || $l['availability_status'] === 'unavailable') {
                $active_leases++;
            }
        }
        $total_parcels = count($all_lands);

        $GLOBALS['_landowner_manage_land_data'] = compact(
            'message', 'message_type', 'edit_land', 'all_lands',
            'total_parcels', 'total_area', 'active_leases'
        );
    }


    public function farmerList(): void
    {
        $search_query = '';
        if (isset($_GET['search'])) {
            $search_query = trim($_GET['search']);
        }

        $farmers = $this->farmerModel->searchVerifiedFarmers($search_query);

        $GLOBALS['_landowner_farmer_list_data'] = compact('farmers', 'search_query');
    }
}
