<?php

class DatatableDatasourceClass {

    public function datasourceProblem() {
        $aColumns = array('problem_running_id', 'catm', 'problem_id', 'problem_name', 'problem_desc', 'cause', 'howto', 'begin_date', 'end_date', 'status');
        $sIndexColumn = "catm";
        $sTable = "tab_problem INNER JOIN tab_problem_dic ON tab_problem.problem_id = tab_problem_dic.problem_dic_id";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceGroupMember() {
        $aColumns = array('member_pid', 'fname', 'lname', 'member_career', 'member_address', 'member_phone1', 'member_phone2');
        $sIndexColumn = "member_pid";
        $sTable = "tab_group_member";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceOtop() {
        $aColumns = array('otop_id', 'catm', 'otop_star', 'otop_name', 'otop_type_name', 'otop_detail', 'otop_group', 'contract_name', 'contract_tel', 'contract_addr');
        $sIndexColumn = "otop_id";
        $sTable = "tab_otop INNER JOIN tab_otop_type ON tab_otop.otop_type = tab_otop_type.otop_type_id";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceTravel() {
        $aColumns = array('travel_id', 'catm', 'travel_star', 'travel_name', 'travel_type_name', 'travel_detail', 'latitude', 'longtitude', 'contract_name', 'contract_addr', 'contract_tel');
        $sIndexColumn = "travel_id";
        $sTable = "tab_travel INNER JOIN tab_travel_type ON tab_travel.travel_type = tab_travel_type.travel_type";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceActivity() {
        $aColumns = array('act_id', 'catm', 'act_desc', 'act_start', 'act_stop', 'pic_no');
        $sIndexColumn = "act_id";
        $sTable = "tab_activity";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceMeeting() {
        $aColumns = array('meeting_id', 'catm', 'meeting_name', 'meeting_date', 'pic_no');
        $sIndexColumn = "meeting_id";
        $sTable = "tab_meeting";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourcePlan() {
        $aColumns = array('plan_id', 'catm', 'plan_name', 'type', 'plan_date', 'size', 'budget', 'head', 'budget_resource', 'start_year', 'end_year', 'status', 'pic_no');
        $sIndexColumn = "plan_id";
        $sTable = "tab_plan";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    public function datasourceGroupPositionCareer() {
        $aColumns = array('position_id', 'catm', 'position_name', 'position_member', 'position_budget');
        $sIndexColumn = "position_id";
        $sTable = "tab_group_position_career";
        $sWhere = "WHERE catm = " . Session::get('catmId');
        $this->generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere);
    }

    private function generateDatatableJson($aColumns, $sIndexColumn, $sTable, $sWhere = "") {
        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " . mysql_real_escape_string($_GET['iDisplayLength']);
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            if ($sWhere == "") {
                $sWhere = "WHERE (";
            } else {
                $sWhere .= " AND (";
            }
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
			SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
			FROM   $sTable
			$sWhere
			$sOrder
			$sLimit
			";

        //$rResult = mysql_query($sQuery, $this->db_village_center->conn_id) or die(mysql_error());
        $rResult = DB::select($sQuery);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS FOUND_ROWS";
        //$rResultFilterTotal = mysql_query($sQuery, $this->db_village_center->conn_id) or die(mysql_error());
        $rResultFilterTotal = DB::select($sQuery);
        //$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $rResultFilterTotal[0]->FOUND_ROWS;
        /* Total data set length */
        $sQuery = "SELECT COUNT(`" . $sIndexColumn . "`) AS COUNT FROM   $sTable";
        //$rResultTotal = mysql_query($sQuery, $this->db_village_center->conn_id) or die(mysql_error());
        $rResultTotal = DB::select($sQuery);
        //$aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $rResultTotal[0]->COUNT;

        /*
         * Output
         */
        $output = array(
            //"sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal, "iTotalDisplayRecords" => $iFilteredTotal, "aaData" => array());

        //while ($aRow = mysql_fetch_array($rResult)) {
        foreach ($rResult as $aRow) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow->$aColumns[$i] == "0") ? '-' : $aRow->$aColumns[$i];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow->$aColumns[$i];
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode($output);
    }

}
