# F07 — Filtering & Basic Search

## Objective
Add only the filtering/search behavior explicitly required by the inspected application requirements.

## User Stories

### US-01
**Given** multiple Todos exist with differing states or searchable values  
**When** the user applies a supported filter/search input  
**Then** only matching Todos are displayed.

### US-02
**Given** the filter/search input matches no Todos  
**When** the result is rendered  
**Then** an appropriate empty-result state is shown without errors.

### US-03
**Given** the user changes or clears the filter/search input  
**When** the Livewire state updates  
**Then** the displayed results reflect the current input.

## Scope
- Before implementation, inspect the repository and requirements to determine the exact filter/search dimensions.
- Do not invent search semantics, ranking, fuzzy matching, debounce timing, or pagination.
- Keep queries efficient and testable.
- Add focused tests.

## Input → Validation → Process → Output
- **Input:** Supported filter/search controls.
- **Validation:** Apply only valid, defined filter values and safe query inputs.
- **Process:** Build the appropriate query/state transformation.
- **Output:** Matching results or empty state.

## Completion Gate
Verify each supported filter/search scenario, no-match behavior, clearing/changing input, and query correctness. Then commit, merge, push, mark F07 complete, and continue.
