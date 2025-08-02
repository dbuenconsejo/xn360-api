from fastapi import APIRouter, Depends, HTTPException
from typing import List
from sqlalchemy.orm import Session
from app.models.sales_order import SalesOrder, SessionLocal
from pydantic import BaseModel

router = APIRouter(prefix="/sales-orders", tags=["Sales Orders"])

# Pydantic schema for response
class SalesOrderSchema(BaseModel):
    id: int
    client_id: int
    client_type: int | None = None
    client_side_id: int | None = None
    employee_id: int | None = None
    sales_person_id: int | None = None
    entered_date: str | None = None
    status: int | None = None
    is_proposal: int | None = None
    is_converted_so: int | None = None
    proposal_version: int | None = None
    is_invoiced: int | None = None
    is_opportunity: int | None = None
    nrc: float | None = None
    mrc: float | None = None
    exp_close_date: str | None = None
    opportunity_title: str | None = None
    ordered_date: str | None = None
    ordered_by_id: int | None = None
    completed_date: str | None = None
    completed_by_id: int | None = None
    notes: str | None = None
    claimed_by_id: int | None = None
    invoiced_id: int | None = None
    total_tax: float | None = None
    total_amount: float | None = None
    sales_title: str | None = None
    sales_stage_id: int | None = None
    sales_stage_month: str | None = None
    location: str | None = None
    description: str | None = None
    template_id: int | None = None
    is_approved: int | None = None

    class Config:
        from_attributes = True

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

def serialize_sales_order(order):
    data = order.__dict__.copy()
    for field in ["entered_date", "ordered_date", "completed_date", "exp_close_date", "sales_stage_month"]:
        value = data.get(field)
        if hasattr(value, "isoformat"):
            data[field] = value.isoformat()
    return data

@router.get("/", response_model=List[SalesOrderSchema])
def list_sales_orders(db: Session = Depends(get_db)):
    orders = db.query(SalesOrder).order_by(SalesOrder.id.desc()).limit(100).all()
    return [SalesOrderSchema(**serialize_sales_order(order)) for order in orders]

@router.get("/{order_id}", response_model=SalesOrderSchema)
def get_sales_order(order_id: int, db: Session = Depends(get_db)):
    order = db.query(SalesOrder).filter(SalesOrder.id == order_id).first()
    if not order:
        raise HTTPException(status_code=404, detail="Sales order not found")
    return SalesOrderSchema(**serialize_sales_order(order))
