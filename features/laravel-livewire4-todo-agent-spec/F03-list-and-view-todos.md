# F03 — List & View Todos

## Objective
Display the user's existing Todos using the application's Livewire 4 UI.

## User Stories

### US-01
**Given** Todos exist  
**When** the Todo list is opened  
**Then** the existing Todos are rendered according to the application's established UI conventions.

### US-02
**Given** no Todos exist  
**When** the Todo list is opened  
**Then** the application renders an appropriate empty state without errors.

### US-03
**Given** Todo data exists in persistence  
**When** the list is loaded  
**Then** the displayed data matches the persisted data.

## Scope
- Implement the Todo list/view behavior.
- Inspect existing routing, layouts, components, and styling before changing them.
- Do not invent pagination, sorting, filtering, search, or authorization behavior; those belong to later features unless already required by the existing project.
- Add focused tests.

## Input → Validation → Process → Output
- **Input:** Existing Todo records or an empty dataset.
- **Validation:** Confirm data can be loaded using the established model/query conventions.
- **Process:** Query and render the Todo collection.
- **Output:** Correct list or empty state.

## Completion Gate
Verify populated and empty states and data correctness. Then commit, merge, push, mark F03 complete, and continue.
