<!-- BEGIN OFFCANVAS LEFT -->
<div class="offcanvas">
</div><!--end .offcanvas-->
<!-- END OFFCANVAS LEFT -->
<?php
    include "functions.php";
    $occups = ['occupation_Accountant' => 'Accountant', 'occupation_Architect' => 'Architect', 'occupation_Developer' => 'Developer', 'occupation_Doctor' => 'Doctor', 'occupation_Engineer' => 'Engineer', 'occupation_Entrepreneur' => 'Entrepreneur', 'occupation_Journalist' => 'Journalist', 'occupation_Lawyer' => 'Lawyer', 'occupation_Manager' => 'Manager', 'occupation_Mechanic' => 'Mechanic', 'occupation_Media_Manager' => 'Media_Manager', 'occupation_Musician' => 'Musician', 'occupation_Scientist' => 'Scientist', 'occupation_Teacher' => 'Teacher', 'occupation_Writer' => 'Writer','occupation_Other' => 'Other'];
    $tols = ['tol_auto_loan' => 'Auto Loan', 'tol_mortgage_loan' => 'Mortgage Loan', 'tol_credit_builder_loan' => 'Credit Builder Loan', 'tol_student_loan' => 'Student Loan', 'tol_home_equity_loan' => 'Home Equity Loan', 'tol_payday_loan' => 'Payday Loan', 'tol_not_specified' => 'Not Specified', 'tol_personal_loan' => 'Personal Loan', 'tol_debt_consolidation_loan' => 'Debt Consolidation Loan'];
    if(isset($_GET['submit'])){
        $params = [];
        // var_dump(isset($_GET['tol']));
        // var_dump($_GET);
        $query = '';
        // $age 				= (($_GET['age'] == '') || ($_GET['age'] == ' ')) ? 0 : (int)$_GET['age'];
        $month 				= (((int)$_GET['month'] < 1) && ((int)$_GET['month'] > 12)) ? 1 : (int)$_GET['month'];
        $num_bank_accounts 	= (($_GET['num_bank_accounts'] == '') || ($_GET['num_bank_accounts'] == ' ')) ? 0 : (int)$_GET['num_bank_accounts'];
        $num_credit_card 	= (($_GET['num_credit_card'] == '') || ($_GET['num_credit_card'] == ' ')) ? 0 : (int)$_GET['num_credit_card'];
        $interest_rate 		= (($_GET['interest_rate'] == '') || ($_GET['interest_rate'] == ' ')) ? 0 : (int)$_GET['interest_rate'];
        $credit_mix 		= (((int)$_GET['credit_mix'] < 0) && ((int)$_GET['credit_mix'] > 2)) ? 0 : (int)$_GET['credit_mix'];
        $delay_from_due_date 	= (($_GET['delay_from_due_date'] == '') || ($_GET['delay_from_due_date'] == ' ')) ? 0 : (int)$_GET['delay_from_due_date'];
        $changed_credit_limit 	= (($_GET['changed_credit_limit'] == '') || ($_GET['changed_credit_limit'] == ' ')) ? 0 : (int)$_GET['changed_credit_limit'];
        $payment_behaviour 		= (((int)$_GET['payment_behaviour'] < 0) && ((int)$_GET['payment_behaviour'] > 5)) ? 0 : (int)$_GET['payment_behaviour'];
        $num_of_delayed_payment = (($_GET['num_of_delayed_payment'] == '') || ($_GET['num_of_delayed_payment'] == ' ')) ? 0 : (int)$_GET['num_of_delayed_payment'];
        $num_credit_inquiries 	= (($_GET['num_credit_inquiries'] == '') || ($_GET['num_credit_inquiries'] == ' ')) ? 0 : (int)$_GET['num_credit_inquiries'];
        $credit_history_age 	= (($_GET['credit_history_age'] == '') || ($_GET['credit_history_age'] == ' ')) ? 0 : (int)$_GET['credit_history_age'];
        $payment_of_min_amount 	= (((int)$_GET['payment_of_min_amount'] < 0) && ((int)$_GET['payment_of_min_amount'] > 1)) ? 0 : (int)$_GET['payment_of_min_amount'];
        $occupation 			= (in_array($_GET['occupation'], array_keys(occups))) ? $_GET['occupation'] : 'occupation_Engineer';
        $monthly_inhand_salary 	= (($_GET['monthly_inhand_salary'] == '') || ($_GET['monthly_inhand_salary'] == ' ')) ? 0 : (int)$_GET['monthly_inhand_salary'];
        $total_emi_per_month	= (($_GET['total_emi_per_month'] == '') || ($_GET['total_emi_per_month'] == ' ')) ? 0 : (int)$_GET['total_emi_per_month'];
        $outstanding_debt 		= (($_GET['outstanding_debt'] == '') || ($_GET['outstanding_debt'] == ' ')) ? 0 : (int)$_GET['outstanding_debt'];
        $amount_invested_monthly  = (($_GET['amount_invested_monthly'] == '') || ($_GET['amount_invested_monthly'] == ' ')) ? 0 : (int)$_GET['amount_invested_monthly'];
        $credit_utilization_ratio = (($_GET['credit_utilization_ratio'] == '') || ($_GET['credit_utilization_ratio'] == ' ')) ? 0 : (int)$_GET['credit_utilization_ratio'];
        $monthly_balance 		= (($_GET['monthly_balance'] == '') || ($_GET['monthly_balance'] == ' ')) ? 0 : (int)$_GET['monthly_balance'];
        $annual_income 			= (($_GET['annual_income'] == '') || ($_GET['annual_income'] == ' ')) ? 0 : (int)$_GET['annual_income'];

        $age = trim($_GET['age']);
        if(is_numeric($age) && ($age < 30)) {
            $age_lvl = "age_youth";
        } elseif(is_numeric($age) && (($age >= 30) || ($age <= 40))) {
            $age_lvl = "age_middle";
        } elseif(is_numeric($age) && ($age > 40)) {
            $age_lvl = "age_senior";
        } else {
            $age_lvl = "age_youth";
        }

        $debt_income_ratio = $outstanding_debt / $annual_income; 
        $debt_income_ratio = is_nan($debt_income_ratio) ? 0 : $debt_income_ratio;
        $emi_salary_ratio = $total_emi_per_month / $monthly_inhand_salary;
        $emi_salary_ratio = is_nan($emi_salary_ratio) ? 0 : $emi_salary_ratio;

        // $query = "age={$age}&month={$month}&num_bank_accounts={$num_bank_accounts}&num_credit_card={$num_credit_card}&interest_rate={$interest_rate}&credit_mix={$credit_mix}&delay_from_due_date={$delay_from_due_date}&changed_credit_limit={$changed_credit_limit}&payment_behaviour={$payment_behaviour}&num_of_delayed_payment={$num_of_delayed_payment}&num_credit_inquiries={$num_credit_inquiries}&credit_history_age={$credit_history_age}&payment_of_min_amount={$payment_of_min_amount}&{$occupation}=True&monthly_inhand_salary={$monthly_inhand_salary}&total_emi_per_month={$total_emi_per_month}&outstanding_debt={$outstanding_debt}&credit_utilization_ratio={$credit_utilization_ratio}&monthly_balance={$monthly_balance}&debt_income_ratio={$debt_income_ratio}&emi_salary_ratio={$emi_salary_ratio}";		
        // $params['age'] = $age;
        $params[$age_lvl] = 1;
        $params['month'] = $month;
        $params['num_bank_accounts'] = $num_bank_accounts;
        $params['num_credit_card'] = $num_credit_card;
        $params['interest_rate'] = $interest_rate;
        $params['credit_mix'] = $credit_mix;	
        $params['delay_from_due_date'] = $delay_from_due_date;
        $params['changed_credit_limit'] = $changed_credit_limit;
        $params['payment_behaviour'] = $payment_behaviour;
        $params['num_of_delayed_payment'] = $num_of_delayed_payment;
        $params['num_credit_inquiries'] = $num_credit_inquiries;
        $params['credit_history_age'] = $credit_history_age;
        $params['payment_of_min_amount'] = $payment_of_min_amount;
        $params[$occupation] = true;
        $params['monthly_inhand_salary'] = $monthly_inhand_salary;
        $params['total_emi_per_month'] = $total_emi_per_month;
        $params['outstanding_debt'] = $outstanding_debt;
        $params['credit_utilization_ratio'] = $credit_utilization_ratio;
        $params['monthly_balance'] = $monthly_balance;
        $params['debt_income_ratio'] = $debt_income_ratio;
        $params['emi_salary_ratio'] = $emi_salary_ratio;
        if(isset($_GET['tol']) == FALSE) {
            $tol_no_loan = 1;
            $query .= '&tol_no_loan=1';
            $params['tol_no_loan'] = 1;
        } else {
            $loans = $_GET['tol'];
            foreach($loans as $k => $tol) {
                $query .= "&{$k}={$tol}";
                $params[$k] = $tol;
            }
        } 
        // print_r($params);
        // $req_url = 'http://127.0.0.1:8000/cresco/predict/?'.$query;
        $req_url = 'http://127.0.0.1:8000/cresco/predict/';
        $do_req = reqUrl($req_url, json_encode($params));
        // $test_url = 'http://127.0.0.1:8000/cresco/';
        // $api_req = file_get_contents($test_url);
        $req_res = json_decode($do_req);
        // print_r($req_res);
        if($req_res->score == 'Good') {
            $msg = '
            <div class="section-header contain-lg">
                <div class="alert alert-success" role="alert">
                    <strong>'.$req_res->score.'</strong> Credit Score. <a href="http://localhost:8888/credit-score/">Reset</a>
                </div>
            </div>
            ';
        } elseif($req_res['score'] == 'Standard') {
            $msg = '
            <div class="section-header contain-lg">
                <div class="alert alert-info" role="alert">
                    <strong>'.$req_res->score.'</strong> Credit Score. <a href="http://localhost:8888/credit-score/">Reset</a>
                </div>
            </div>
            ';
        } else {
            $msg = '
            <div class="section-header contain-lg">
                <div class="alert alert-warning" role="alert">
                    <strong>'.$req_res->score.'</strong> Credit Score. <a href="http://localhost:8888/credit-score/">Reset</a>
                </div>
            </div>
            ';
        }
    }
    else {
        $msg = '';
    }
?>

<!-- BEGIN CONTENT-->
<div id="content">
    <section>
        <div class="section-header contain-lg">
            <ol class="breadcrumb">
                <li class="active">Credit Score Classification</li>
            </ol>
        </div>
        <?= $msg; ?>
        <div class="section-body contain-lg">

            <!-- BEGIN VERTICAL FORM -->
            <div class="row">
                <div class="col-md-8" style="width:100%">
                    <form class="form" action="<?= $base_url; ?>credit-score-classification/web/form">
                        <div class="card">
                            <div class="card-head style-primary">
                                <header>Customer Info</header>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="age" id="age">
                                            <label for="Age">Age</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select id="month" name="month" class="form-control">
                                                    <?php
                                                    $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                                                    $nm = 1;
                                                    foreach($months as $month){
                                                    ?>
                                                <option value="<?= $nm; ?>"><?= $month; ?></option>
                                                <?php
                                                        $nm += 1; 
                                                    } 
                                                ?>
                                            </select>
                                            <label for="month">Month</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="num_bank_accounts" id="num_bank_accounts">
                                            <label for="num_bank_accounts">Num. of Bank Accounts</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="num_credit_card" id="num_credit_card">
                                            <label for="num_credit_card">Num. of Credit Card</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="interest_rate" id="interest_rate">
                                            <label for="interest_rate">Interest Rate</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select id="credit_mix" name="credit_mix" class="form-control">
                                                    <?php
                                                    $credit_mix = ['Bad','Standard','Good'];
                                                    // $ncm = 1;
                                                    foreach($credit_mix as $ncm => $credit_mix){
                                                    ?>
                                                <option value="<?= $ncm; ?>"><?= $credit_mix; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="credit_mix">Credit Mix</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="delay_from_due_date" name="delay_from_due_date">
                                            <label for="delay_from_due_date">Delay From Due Date</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="changed_credit_limit" name="changed_credit_limit">
                                            <label for="changed_credit_limit">Changed Credit Limit</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select id="payment_behaviour" name="payment_behaviour" class="form-control">
                                                    <?php
                                                    $paybes = ['Low_spent_Small_value_payments','Low_spent_Medium_value_payments','Low_spent_Large_value_payments','High_spent_Small_value_payments','High_spent_Medium_value_payments','High_spent_Large_value_payments'];
                                                    // $ncm = 1;
                                                    foreach($paybes as $npb => $paybe){
                                                    ?>
                                                <option value="<?= $npb; ?>"><?= $paybe; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="payment_behaviour">Payment Behaviour</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="num_of_delayed_payment" name="num_of_delayed_payment">
                                            <label for="num_of_delayed_payment">Num. of Delayed Payment</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="num_credit_inquiries" name="num_credit_inquiries">
                                            <label for="num_credit_inquiries">Num. of Credit Inquiries</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="credit_history_age" name="credit_history_age">
                                            <label for="credit_history_age">Credit History Age</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select id="payment_of_min_amount" name="payment_of_min_amount" class="form-control">
                                                    <?php
                                                    $minam = ['No','Yes'];
                                                    foreach($minam as $nma => $minam){
                                                    ?>
                                                <option value="<?= $nma; ?>"><?= $minam; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="payment_of_min_amount">Payment Min. Amount</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select id="occupation" name="occupation" class="form-control">
                                                    <?php
                                                    foreach($occups as $voc => $occup){
                                                    ?>
                                                <option value="<?= $voc; ?>"><?= $occup; ?></option>
                                                <?php } ?>
                                            </select>
                                            <label for="occupation">Occupation</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="monthly_inhand_salary" name="monthly_inhand_salary">
                                            <label for="monthly_inhand_salary">Monthly Salary</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="total_emi_per_month" name="total_emi_per_month">
                                            <label for="total_emi_per_month">Monthly EMI</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="outstanding_debt" name="outstanding_debt">
                                            <label for="outstanding_debt">Outstanding Debt</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">Type Of Loan</label>
                                        <div class="col-sm-11" style="float:right;">
                                        <?php 
                                            foreach($tols as $ntl => $tol) {
                                        ?>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input type="checkbox" value="1" name="tol[<?= $ntl; ?>]"><span><?= $tol; ?></span>
                                        </label>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="credit_utilization_ratio" name="credit_utilization_ratio">
                                            <label for="credit_utilization_ratio">Credit Utilization Ratio</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="amount_invested_monthly" name="amount_invested_monthly">
                                            <label for="amount_invested_monthly">Amounnt Invsted Monthly</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="monthly_balance" name="monthly_balance">
                                            <label for="monthly_balance">Monthly Balance</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="annual_income" name="annual_income">
                                            <label for="annual_income">Annual Income</label>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <button type="submit" name="submit" value="submit" class="btn btn-flat btn-primary ink-reaction">Submit</button>
                                </div>
                            </div>
                        </div><!--end .card -->
                        <em class="text-caption">Vertical layout with static labels</em>
                    </form>
                </div><!--end .col -->
            </div><!--end .row -->
            <!-- END VERTICAL FORM -->

        </div>
    </section>
</div><!--end #content-->
<!-- END CONTENT -->