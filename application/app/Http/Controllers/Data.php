<?php
namespace App\Http\Controllers;
use App\Models\States;
use App\Models\Beds;
use App\Models\Oxygen;
use App\Models\Plasma;
use App\Models\Ambulance;
use App\Models\Meds;
use App\Models\Tiffin;
use App\Models\Helpdesk;
use App\Models\Tele_consultation;

use Illuminate\Http\Request;

class Data extends Controller
{
    public function getAllStates($specialSelect=false){
        $state_data = States::all()->toArray();
        $state_json = array();
        foreach ($state_data as $value) {
            $json = array();
            if ($specialSelect) {
                $json["option_name"] = $value["state_code"];
                $json["option_value"] = $value["state_name"];
            }else{
                $json["state_code"] = $value["state_code"];
                $json["state_name"] = $value["state_name"];
                $json["state_type"] = $value["state_type"];
            }
            $state_json[] = $json;
        }
        return $state_json;
    }

    public function getDetails(Request $request, $state, $mode){
        $mode = strtolower($mode);
        $returnData = array();
        if ($mode=="beds") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation: </b>%s</div>
                                <div><b>Category: </b>%s</div>
                                <div><b>Number of Beds Available: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Verified: </b>%s</div>
                                <div><b>Current Status: </b>%s</div>
                                <div><b>Verification Time and Date: </b>%s</div>
                                <div><b>Important Information: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Beds::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"], $value["category"],
                                        $value["availability"], getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="oxygen") {
            $html = '<div class="bottom_div_container">
                        <div class="list_li" beds_code="%s">
                            <div class="listLogo">
                                <div class="listLogoStyle">%s</div>
                            </div>
                            <div class="listTextContainer">
                                <div class="listTextStyle">%s</div>
                                <div class="listTextDetailStyle">%s</div>
                            </div>
                            <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                        </div>
                        <div class="bottom_div">
                            <div><b>Organisation: </b>%s</div>
                            <div><b>Category: </b>%s</div>
                            <div><b>State: </b>%s</div>
                            <div><b>Location: </b>%s</div>
                            <div><b>Number: </b>%s</div>
                            <div><b>Verified: </b>%s</div>
                            <div><b>Current Status: </b>%s</div>
                            <div><b>Verification Time and Date: </b>%s</div>
                            <div><b>Important Information: </b>%s</div>
                        </div>
                    </div>';
            $bedsData = Oxygen::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"], $value["category"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="plasma") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Verified: </b>%s</div>
                                <div><b>Current Status: </b>%s</div>
                                <div><b>Verification Time and Date: </b>%s</div>
                                <div><b>Important Information: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Plasma::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="ambulance") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Verified: </b>%s</div>
                                <div><b>Current Status: </b>%s</div>
                                <div><b>Verification Time and Date: </b>%s</div>
                                <div><b>Important Information: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Ambulance::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="meds") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation: </b>%s</div>
                                <div><b>Medicine Name: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Verified: </b>%s</div>
                                <div><b>Current Status: </b>%s</div>
                                <div><b>Verification Time and Date: </b>%s</div>
                                <div><b>Important Information: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Meds::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"], $value["medicine_name"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="tiffin") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation: </b>%s</div>
                                <div><b>Meal: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Verified: </b>%s</div>
                                <div><b>Current Status: </b>%s</div>
                                <div><b>Verification Time and Date: </b>%s</div>
                                <div><b>Important Information: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Tiffin::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        boolval($value["isVerified"])? "Verified":"Not Verified", $value["organisation_name"], $value["meal"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"],
                                        boolval($value["isVerified"])? "Yes":"No", $value["current_status"], $value["verifiedAt"],
                                        $value["important_info"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="helpdesk") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Organisation Name: </b>%s</div>
                                <div><b>Organisation Type: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Remarks: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Helpdesk::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["organisation_name"], 0, 1)), ucwords(strtolower($value["organisation_name"])),
                                        "", $value["organisation_name"], $value["organisation_type"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"], $value["remarks"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        else if ($mode=="tele_consultation") {
            $html = '<div class="bottom_div_container">
                            <div class="list_li" beds_code="%s">
                                <div class="listLogo">
                                    <div class="listLogoStyle">%s</div>
                                </div>
                                <div class="listTextContainer">
                                    <div class="listTextStyle">%s</div>
                                    <div class="listTextDetailStyle">%s</div>
                                </div>
                                <div class="listNavigationIcon"> <span class="material-icons">chevron_right</span> </div>
                            </div>
                            <div class="bottom_div">
                                <div><b>Doctor Name: </b>%s</div>
                                <div><b>Type: </b>%s</div>
                                <div><b>State: </b>%s</div>
                                <div><b>Location: </b>%s</div>
                                <div><b>Number: </b>%s</div>
                                <div><b>Remarks: </b>%s</div>
                            </div>
                        </div>';
            $bedsData = Tele_consultation::where("state", $state)->orderBy("id", "desc")->get()->toArray();
            $bedsJson = array();
            foreach ($bedsData as $value) {
                $bedsJson[] = sprintf($html, $value["id"], strtoupper(substr($value["doctor_name"], 0, 1)), ucwords(strtolower($value["doctor_name"])),
                                        "", $value["doctor_name"], $value["type"],
                                        getStateByCode($value["state"]), $value["location"], $value["phone"], $value["remarks"]);
            }
            return array("error"=>false,"html"=>implode("", $bedsJson));
        }
        return array("error"=>false,"html"=>"");
    }

    public function getFormData(Request $request, $mode){
        $mode = strtolower($mode);
        $returnData = array("error"=>false, "inputs"=>array());
        if ($mode=="beds") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "category",
                    "title" => "Category",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "availability",
                    "title" => "No. Of beds available",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "verifiedAt",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="oxygen") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "category",
                    "title" => "Category",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "verifiedAt",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="plasma") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "verifiedAt",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="ambulance") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "verifiedAt",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="meds") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "medicine_name",
                    "title" => "Medicine Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "verifiedAt",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="tiffin") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "Meal",
                    "title" => "meal",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "current_status",
                    "title" => "Current Status",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "important_info",
                    "title" => "Important Info",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "isVerified",
                    "title" => "isVerified",
                    "isRequired" => false,
                    "type" => "select",
                    "options" => array(
                        array(
                            "option_value" => "1",
                            "option_text" => "Verified"
                        ),
                        array(
                            "option_value" => "0",
                            "option_text" => "Not Verified"
                        )
                    )
                ),
                array(
                    "name" => "verifiedAt",
                    "title" => "Verified At",
                    "isRequired" => false,
                    "type" => "date"
                )
            ));
        }
        else if ($mode=="helpdesk") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "organisation_name",
                    "title" => "Organisation Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "organisation_type",
                    "title" => "Organisation Type",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "remarks",
                    "title" => "Remarks",
                    "isRequired" => false,
                    "type" => "input"
                )
            ));
        }
        else if ($mode=="tele_consultation") {
            $returnData = array("error"=>false, "inputs"=>array(
                array(
                    "name" => "doctor_name",
                    "title" => "Doctor Name",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "type",
                    "title" => "Type",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "phone",
                    "title" => "Phone",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "location",
                    "title" => "location",
                    "isRequired" => false,
                    "type" => "input"
                ),
                array(
                    "name" => "remarks",
                    "title" => "Remarks",
                    "isRequired" => false,
                    "type" => "input"
                )
            ));
        }
        return $returnData;
    }

    public function submitData(Request $request, $state, $mode){
        $mode = strtolower($mode);
        $create_data = [];
        $data = $request->all();
        if (isset($data["isVerified"])) {
            $data["isVerified"] = strtolower($data["isVerified"])=="verified";
        }
        if (isset($data["verifiedAt"])) {
            $data["verifiedAt"] = date("Y-m-d H:i:s", strtotime($data["verifiedAt"]));
        }
        $data["state"] = $state;
        if ($mode=="beds") {
            $create_data = Beds::create($data);
        }
        else if ($mode=="oxygen") {
            $create_data = Oxygen::create($data);
        }
        else if ($mode=="plasma") {
            $create_data = Plasma::create($data);
        }
        else if ($mode=="ambulance") {
            $create_data = Ambulance::create($data);
        }
        else if ($mode=="meds") {
            $create_data = Meds::create($data);
        }
        else if ($mode=="tiffin") {
            $create_data = Tiffin::create($data);
        }
        else if ($mode=="helpdesk") {
            $create_data = Helpdesk::create($data);
        }
        else if ($mode=="tele_consultation") {
            $create_data = Tele_consultation::create($data);
        }
        return $create_data;
    }
}
