<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div wire:ignore x-data="{ 
            state: $wire.$entangle('{{ $getStatePath() }}'),
            initEditor() {
                if (window.CKEDITOR_LOADED) {
                    this.createEditor();
                    return;
                }
                
                const script = document.createElement('script');
                script.src = 'https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js';
                script.onload = () => {
                    window.CKEDITOR_LOADED = true;
                    this.createEditor();
                };
                document.head.appendChild(script);
            },
            createEditor() {
                ClassicEditor
                    .create(this.$refs.editor, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            this.state = editor.getData();
                        });
                        
                        // Set initial data
                        if (this.state) {
                            editor.setData(this.state);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
         }" x-init="initEditor()">
        <div x-ref="editor"></div>
    </div>
</x-dynamic-component>