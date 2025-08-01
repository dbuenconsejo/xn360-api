from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI(
    title="XN360 API",
    version="0.1.0",
    docs_url="/docs",
    redoc_url="/redoc",
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
