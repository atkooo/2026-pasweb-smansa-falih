@props([
    'id', 
    'title', 
    'formAction' => null, 
    'formMethod' => 'POST', 
    'enctype' => null, 
    'submitLabel' => 'Simpan Perubahan',
    'submitIcon' => 'fas fa-save',
    'formId' => null
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0 py-3" style="border-radius: 1rem 1rem 0 0;">
                <h5 class="modal-title font-weight-bold text-dark" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            @if($formAction)
                <form id="{{ $formId ?? 'form'.$id }}" action="{{ $formAction }}" method="{{ strtoupper($formMethod) === 'GET' ? 'GET' : 'POST' }}" {!! $enctype ? 'enctype="'.$enctype.'"' : '' !!}>
                    @csrf
                    @if(!in_array(strtoupper($formMethod), ['GET', 'POST']))
                        @method($formMethod)
                    @endif
                    
                    <div class="modal-body px-4 py-4">
                        {{ $slot }}
                    </div>
                    
                    <div class="modal-footer border-0 bg-light py-3" style="border-radius: 0 0 1rem 1rem;">
                        <button type="button" class="btn btn-secondary font-weight-bold px-4" data-dismiss="modal" style="border-radius: 0.5rem;">Batal</button>
                        <button type="submit" class="btn btn-primary font-weight-bold px-4 btn-submit" style="border-radius: 0.5rem; background-color: #4f46e5; border-color: #4f46e5;">
                            <i class="{{ $submitIcon }} mr-2"></i> {{ $submitLabel }}
                        </button>
                    </div>
                </form>
            @else
                <div class="modal-body px-4 py-4">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</div>
