from fastapi import APIRouter, HTTPException
from typing import List
from app.db import get_db_connection
from app.models.sales_order import SalesOrder
import datetime

router = APIRouter(prefix="/sales-orders", tags=["Sales Orders"])

def row_to_sales_order(row):
    # Convert date/datetime fields to ISO strings
    for k, v in row.items():
        if isinstance(v, (datetime.date, datetime.datetime)):
            row[k] = v.isoformat()
    return SalesOrder(**row)

@router.get("/", response_model=List[SalesOrder])
def list_sales_orders():
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM sales_order_portals ORDER BY created_at DESC LIMIT 100")
    rows = cursor.fetchall()
    cursor.close()
    conn.close()
    return [row_to_sales_order(row) for row in rows]

@router.get("/{order_id}", response_model=SalesOrder)
def get_sales_order(order_id: int):
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT * FROM sales_order_portals WHERE id = %s LIMIT 1", (order_id,))
    row = cursor.fetchone()
    cursor.close()
    conn.close()
    if not row:
        raise HTTPException(status_code=404, detail="Sales order not found")
    return row_to_sales_order(row)
