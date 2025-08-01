from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from app.routes.sales_order import router as sales_order_router

app = FastAPI(
    title="XN360 API",
    version="0.1.0",
    docs_url="/docs",
    redoc_url="/redoc",
    description="""
XN360 API

Sales Order Endpoints:
- **GET /sales-orders**: List all sales orders (from sales_order_portal)
- **GET /sales-orders/{order_id}**: Get a sales order by ID

Other endpoints:
- **/health**: Health check
- **/sample**: Sample response
""",
    openapi_tags=[
        {
            "name": "Sales Orders",
            "description": "Operations related to sales orders (from sales_order_portal table)."
        },
        {
            "name": "Health",
            "description": "Health check endpoint."
        },
        {
            "name": "Sample",
            "description": "Sample endpoint for testing."
        }
    ]
)

# CORS setup: allow all origins for dev, restrict in prod
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Change to specific domains in production!
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

@app.get("/health", tags=["Health"])
def health():
    return {"status": "ok"}

@app.get("/sample", tags=["Sample"])
def sample():
    return {
        "message": "This is a sample response",
        "data": {
            "id": 1,
            "name": "Sample Item",
            "status": "active"
        }
    }

app.include_router(sales_order_router)