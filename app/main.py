import os
import io
import pickle
import joblib
import pandas as pd
import numpy as np
from fastapi import FastAPI, File, UploadFile
from pydantic import BaseModel
from json import loads, dumps

app = FastAPI()

UPLOAD_DIR = "app/upload"
os.makedirs(UPLOAD_DIR, exist_ok=True)

# Load feature list that used on training
expected_features = joblib.load("app/feature_names.pkl")
# with open("app/feature_names.pkl", "rb") as fena:
#     expected_features = pickle.load(fena)

# Load the trained model
model = joblib.load("app/credit_score_model.pkl")
# with open("app/credit_score_model.pkl", "rb") as file:
#     model = pickle.load(file)

# Define the data model
class CrescoInput(BaseModel):
    month: int = 1
    monthly_inhand_salary: float = 0.0
    total_emi_per_month: float = 0.0
    num_bank_accounts: int = 1
    num_credit_card: int = 1
    interest_rate: int = 1
    delay_from_due_date: int = 0
    num_of_delayed_payment: int = 0
    changed_credit_limit: float = 0.0
    num_credit_inquiries: int = 0
    credit_mix: int = 1
    outstanding_debt: float = 0.0
    credit_utilization_ratio: float = 0.0
    credit_history_age: int = 1
    payment_of_min_amount: int = 1
    amount_invested_monthly: float = 0.0
    payment_behaviour: int = 0
    monthly_balance: float = 0.0
    tol_auto_loan: int = 0
    tol_mortgage_loan: int = 0
    tol_credit_builder_loan: int = 0
    tol_student_loan: int = 0
    tol_home_equity_loan: int = 0
    tol_payday_loan: int = 0
    tol_not_specified: int = 0
    tol_personal_loan: int = 0
    tol_debt_consolidation_loan: int = 0
    occupation_Accountant: bool = False
    occupation_Architect: bool = False
    occupation_Developer: bool = False
    occupation_Doctor: bool = False
    occupation_Engineer: bool = False
    occupation_Entrepreneur: bool = False
    occupation_Journalist: bool = False
    occupation_Lawyer: bool = False
    occupation_Manager: bool = False
    occupation_Mechanic: bool = False
    occupation_Media_Manager: bool = False
    occupation_Musician: bool = False
    occupation_Scientist: bool = False
    occupation_Teacher: bool = False
    occupation_Writer: bool = False
    occupation_Other: bool = False
    age_youth: int = 0
    age_middle: int = 0
    age_senior: int = 0
    debt_income_ratio: float = 0.0
    emi_salary_ratio: float = 0.0

@app.get("/cresco/")
def read_root():
    return {"message": "Welcome to the Credit Score Prediction API"}

@app.post("/cresco/predict/")
def predict_score(input_data: CrescoInput):
    data = np.array([[input_data.month, input_data.monthly_inhand_salary, input_data.total_emi_per_month, 
                      input_data.num_bank_accounts, input_data.num_credit_card, input_data.interest_rate, input_data.delay_from_due_date, 
                      input_data.num_of_delayed_payment, input_data.changed_credit_limit, input_data.num_credit_inquiries, 
                      input_data.credit_mix, input_data.outstanding_debt, input_data.credit_utilization_ratio, input_data.credit_history_age, 
                      input_data.payment_of_min_amount, input_data.amount_invested_monthly, input_data.payment_behaviour, 
                      input_data.monthly_balance, input_data.tol_auto_loan, input_data.tol_mortgage_loan, input_data.tol_credit_builder_loan, 
                      input_data.tol_student_loan, input_data.tol_home_equity_loan, input_data.tol_payday_loan, 
                      input_data.tol_not_specified, input_data.tol_personal_loan, input_data.tol_debt_consolidation_loan, 
                      input_data.occupation_Accountant, input_data.occupation_Architect, input_data.occupation_Developer, 
                      input_data.occupation_Doctor, input_data.occupation_Engineer, input_data.occupation_Entrepreneur, input_data.occupation_Journalist, 
                      input_data.occupation_Lawyer, input_data.occupation_Manager, input_data.occupation_Mechanic, input_data.occupation_Media_Manager, 
                      input_data.occupation_Musician, input_data.occupation_Scientist, input_data.occupation_Teacher, input_data.occupation_Writer,
                      input_data.occupation_Other, input_data.age_youth, input_data.age_middle, input_data.age_senior, input_data.debt_income_ratio, input_data.emi_salary_ratio]])
    prediction = model.predict(data)
    score = ['Poor', 'Standard', 'Good']
    return {"score": score[prediction[0]]}

# File upload
@app.post("/cresco/upload_csv/")
async def upload_csv(my_file: UploadFile = File(...)):
    # file extension validation
    if not my_file.filename.endswith('.csv'):
        return {"error": "File harus berformat CSV"}
    # Read the file content as bytes
    content = await my_file.read()
    try:
        # Use io.BytesIO to build file-like object from bytes
        df = pd.read_csv(io.BytesIO(content))
        new_df = df.copy()
        new_df = featureEngineering(new_df)

        # Sesuaikan fitur dengan model
        for feature in expected_features:
            if feature not in new_df.columns:
                new_df[feature] = 0
        new_df = new_df[expected_features]
        data = np.array(new_df)
        pred = model.predict(data)
    except Exception as e:
        return {"error": f"Gagal membaca file CSV: {str(e)}"}
    # Save the result in the storage
    df['credit_score'] = pred
    file_path = os.path.join('app/upload', f"predicted_{my_file.filename}")
    df.to_csv(file_path, index=False)
    result = df.to_json(orient="index")
    parsed = loads(result)
    return {
        "filename": my_file.filename, 
        "saved_to": file_path,
        "result": parsed
    }


# Feature Engineering
def featureEngineering(df):
    df = mylabelEncode(df)
    df = binPaymentAmount(df)
    df = binTypeLoan(df)
    df = ohOccupation(df)
    df = ageGroup(df)
    df = ratioDebtIncome(df)
    df = ratioEmiSalary(df)
    df = rplCreditAge(df)
    df = convVal(df)
    df = delFeat(df)
    return df


# Label Encoding for feature: credit_mix, month, and payment_behaviour
def mylabelEncode(df):
    or_enc = { # credit_mix
            'credit_mix':{'Bad':0, 'Standard':1, 'Good':2},
            # month
            'month':{'January':1, 'February':2, 'March':3, 'April':4, 'May':5, 'June':6,
                    'July':7, 'August':8, 'September':9, 'October':10, 'November':11, 'December':12},
            # payment_behaviour
            'payment_behaviour':{'Low_spent_Small_value_payments':0,'Low_spent_Medium_value_payments':1,
                                'Low_spent_Large_value_payments':2,'High_spent_Small_value_payments':3,
                                'High_spent_Medium_value_payments':4,'High_spent_Large_value_payments':5}
            }
    for col in or_enc:
        df[col] = df[col].map(or_enc[col])
    return df


# Binary encoding for payment_of_min_amount
def binPaymentAmount(df):
    df['payment_of_min_amount'] = df['payment_of_min_amount'].map({'No':0,'Yes':1})
    return df


# Seperate For Each type_of_loan
def binTypeLoan(df):
    tols = ['payday loan','student loan','not specified','mortgage loan','debt consolidation loan','credit-builder loan',
            'home equity loan','auto loan','personal loan']
    for loan in tols:
        col_name = f"tol_{loan.replace('and ', '').replace(' ', '_').replace('-', '_').replace('/', '_')}"
        df[col_name] = df['type_of_loan'].apply(lambda x: 1 if loan in x.lower() else 0)
    ordered_cols = [f"tol_{loan.replace('and ', '').replace(' ', '_').replace('-', '_').replace('/', '_')}" for loan in tols]
    df = df[[col for col in df.columns if col not in ordered_cols] + ordered_cols]
    return df


# Seperate For Each Occupation
def ohOccupation(df):
    oh_occ = ['Accountant','Architect','Developer','Doctor','Engineer','Entrepreneur','Journalist','Lawyer','Manager',
              'Mechanic','Media_Manager','Musician','Scientist','Teacher','Writer']
    for occ in oh_occ:
        df[f"occupation_{occ}"] = df['occupation'].apply(lambda x: True if occ in x else False)
    # Buat kolom untuk kategori "Other"
    df["occupation_Other"] = df['occupation'].apply(lambda x: all(occ not in x for occ in oh_occ))
    # Atur urutan kolom agar sesuai dengan `oh_occ`
    ordered_cols = [f"occupation_{occ}" for occ in oh_occ] + ["occupation_Other"]
    df = df[[col for col in df.columns if col not in ordered_cols] + ordered_cols]

    return df
    

# Separate age by 3 group
def ageGroup(df):
    df['age'] = df['age'].apply(lambda x: str(x).replace('_','')).astype(str).astype(int)
    df["age_youth"] = [1 if x < 30 else 0 for x in df['age']]
    df["age_middle"] = [1 if x >= 30 and x <= 40 else 0 for x in df['age']]
    df["age_senior"] = [1 if x > 40 else 0 for x in df['age']]
    return df


# Feature Engineering: outstanding_debt / annual_income
def ratioDebtIncome(df):
    df['outstanding_debt'] = df['outstanding_debt'].apply(lambda x: str(x).replace('_','')).astype(str).astype(float)
    df['annual_income'] = df['annual_income'].apply(lambda x: str(x).replace('_','')).astype(str).astype(float)
    df['debt_income_ratio'] = df['outstanding_debt'] / df['annual_income']
    return df


# Feature Engineering: total_emi_per_month / monthly_inhand_salary
def ratioEmiSalary(df):
    df['emi_salary_ratio'] = df['total_emi_per_month'] / df['monthly_inhand_salary']
    return df


# Count "credit_history_age"
def countMonth(df_date):
    split_dt = df_date.split(' Years and ')
    year = int(split_dt[0])
    month = int(split_dt[1].split(' Months')[0])
    couted_month = (year * 12) + month
    return couted_month

# Replace "credit_history_age" value
def rplCreditAge(df):
    df['credit_history_age'] = df['credit_history_age'].apply(lambda x: countMonth(x))
    return df


# Convert values
def convVal(df):
    # Convert num_of_delayed_payment
    df['num_of_delayed_payment'] = df['num_of_delayed_payment'].apply(lambda x: str(x).replace('_','')).astype(str).astype(int)
    # conver credit_history_age
    df['changed_credit_limit'] = df['changed_credit_limit'].apply(lambda x: str(x).replace('_','0')).astype(str).astype(float)
    # conver amount_invested_monthly
    df['amount_invested_monthly'] = df['amount_invested_monthly'].apply(lambda x: str(x).replace('_','')).astype(str).astype(float)
    # Convert monthly_balance
    df['monthly_balance'] = df['monthly_balance'].apply(lambda x: str(x).replace('_','')).astype(str).astype(float)
    # Convert num_credit_inquiries
    df['num_credit_inquiries'] = df['num_credit_inquiries'].astype(int)
    # Convert credit_mix
    df['credit_mix'] = df['credit_mix'].fillna(0).astype(int)
    # Convert payment_behaviour
    df['payment_behaviour'] = df['payment_behaviour'].fillna(0).astype(int)
    # Convert payment_of_min_amount
    df['payment_of_min_amount'] = df['payment_of_min_amount'].fillna(0).astype(int)
    return df


# Delete Unnecesarry features
def delFeat(df):
    df = df.drop(columns=['id','name','customer_id','ssn','num_of_loan','type_of_loan','annual_income','age','occupation','Unnamed: 0'])
    # df = df.drop(columns=['id','name','customer_id','ssn','num_of_loan','type_of_loan','annual_income','age','occupation'])
    return df