<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:Pendente,Concluída',
            'priority' => 'required|in:Baixa,Média,Alta',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O título da tarefa é obrigatório.',
            'name.string' => 'O título da tarefa deve ser uma string.',
            'name.max' => 'O título da tarefa deve ter no máximo 255 caracteres.',
            'description.string' => 'A descrição da tarefa deve ser uma string.',
            'due_date.date' => 'A data de vencimento deve ser uma data válida.',
            'status.required' => 'O status da tarefa é obrigatório.',
            'status.in' => 'O status da tarefa deve ser "Pendente" ou "Concluída".',
            'priority.required' => 'A prioridade da tarefa é obrigatória.',
            'priority.in' => 'A prioridade da tarefa deve ser "Baixa", "Média" ou "Alta".',
            'category_id.required' => 'A categoria da tarefa é obrigatória.',
            'category_id.exists' => 'A categoria selecionada é inválida.',
        ];
    }
}
