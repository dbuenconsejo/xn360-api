# AI Coding Instructions for XN360 Python API

This document defines conventions and best practices for writing code in this FastAPI-based Python API project.

---

## 1. Naming Conventions

- **Files & Folders:**  
  Use `snake_case` for Python files and folders.  
  Example:  
  - `main.py`
  - `app/routes/sample_route.py`

- **Variables & Functions:**  
  Use `snake_case` for variables and function names.  
  Example:  
  ```python
  def get_user_by_id(user_id: int) -> User: ...
  ```

- **Classes & Types:**  
  Use `PascalCase` for class names and Pydantic models.  
  Example:  
  ```python
  class User(BaseModel): ...
  ```

---

## 2. Code Style

- **Indentation:**  
  Use 4 spaces per indentation level.

- **Imports:**  
  - Standard library imports first, then third-party, then local imports.
  - Use absolute imports for project modules.

- **Type Hints:**  
  Use type hints for all function arguments and return types.

- **Docstrings:**  
  Use triple double-quoted strings for module, class, and function docstrings.

- **Comments:**  
  Use `#` for inline comments and block comments.

---

## 3. API Structure

- **Entry Point:**  
  - Use `main.py` as the FastAPI entry point.
  - Place routes in `app/routes/`.

- **Routes:**  
  - Group related endpoints in separate modules under `app/routes/`.
  - Use APIRouter for modularity.

- **Models:**  
  - Use Pydantic models for request and response validation.
  - Place shared models in `app/models/` if needed.

---

## 4. Environment & Configuration

- Use `.env` for environment variables.
- Load environment variables using `python-dotenv` or similar.

---

## 5. Dependency Management

- Pin dependencies in `requirements.txt`.
- Use virtual environments for local development.

---

## 6. Docker & Hot Reload

- Use `uvicorn` with `--reload` for development hot reload.
- Mount the project directory as a volume in Docker for instant code updates.

---

## 7. Example: Route Module

```python
# filepath: app/routes/sample.py
from fastapi import APIRouter

router = APIRouter()

@router.get("/sample", response_model=SampleResponse)
def get_sample():
    """Get a sample item."""
    return SampleResponse(id=1, name="Sample", status="active")
```

---

## 8. AI Prompting

- When asking the AI to generate code, specify:
  - The file path.
  - The desired change or feature.
  - Any relevant context or examples.

---

**Follow these conventions to keep the codebase clean, maintainable, and consistent for Python FastAPI projects.**
