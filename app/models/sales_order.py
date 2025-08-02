from sqlalchemy import Column, Integer, String, Float, Date, create_engine
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker
import os
from dotenv import load_dotenv

load_dotenv()

Base = declarative_base()

class SalesOrder(Base):
    __tablename__ = "sales_order_portals"
    id = Column(Integer, primary_key=True)
    client_id = Column(Integer)
    client_type = Column(Integer)
    client_side_id = Column(Integer)
    employee_id = Column(Integer)
    sales_person_id = Column(Integer)
    entered_date = Column(String)
    status = Column(Integer)
    is_proposal = Column(Integer)
    is_converted_so = Column(Integer)
    proposal_version = Column(Integer)
    is_invoiced = Column(Integer)
    is_opportunity = Column(Integer)
    nrc = Column(Float)
    mrc = Column(Float)
    exp_close_date = Column(String)
    opportunity_title = Column(String)
    ordered_date = Column(String)
    ordered_by_id = Column(Integer)
    completed_date = Column(String)
    completed_by_id = Column(Integer)
    notes = Column(String)
    claimed_by_id = Column(Integer)
    invoiced_id = Column(Integer)
    total_tax = Column(Float)
    total_amount = Column(Float)
    sales_title = Column(String)
    sales_stage_id = Column(Integer)
    sales_stage_month = Column(String)
    location = Column(String)
    description = Column(String)
    template_id = Column(Integer)
    is_approved = Column(Integer)

# Build connection string from env
DB_USER = os.getenv("DB_USERNAME", "root")
DB_PASS = os.getenv("DB_PASSWORD", "")
DB_HOST = os.getenv("DB_HOST", "127.0.0.1")
DB_PORT = os.getenv("DB_PORT", "3306")
DB_NAME = os.getenv("DB_DATABASE", "")

SQLALCHEMY_DATABASE_URL = (
    f"mysql+mysqlconnector://{DB_USER}:{DB_PASS}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
)

engine = create_engine(SQLALCHEMY_DATABASE_URL)
SessionLocal = sessionmaker(bind=engine)
