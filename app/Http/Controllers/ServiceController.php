<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showAddNoteForm()
    {
        return view('pages.s_ProviderServiceNote.addProviderServiceNote');
    }
    // add note by service provider
    public function addNote(Request $request)
    {
        $this->validate(
            $request,
            [
                's_ProviderName' => 'required',
                'productName' => 'required',
                'Address' => 'required',
                'status' => 'required',
                'note' => 'required',
                'serviceProviderId' => 'required',


            ],
        );
        $var = new Service();
        $var->s_ProviderName = $request->s_ProviderName;
        $var->productName = $request->productName;
        $var->Address = $request->Address;
        $var->status = $request->status;
        $var->note = $request->note;
        $var->serviceProviderId= $request->serviceProviderId;

        $var->save();
        $request->session()->flash('note-added', 'Note Added!');
        return redirect('serviceNoteList/' . session('id'));
    }
    public function deleteNote(Request $request)
    {
        $note = Service::where('id', $request->id)->first();
        $note->delete();
        $request->session()->flash('note-delete', 'Note Successfully Deleted!');

        return redirect('/serviceNoteList/' . session('id'));
    }
    // send data for edit note
    public function sendData($id){

        $note = Service::find($id);
        return view('pages.s_ProviderServiceNote.editProviderServiceNote', ['note' => $note]);
    }
    function updateNote(Request $request)
    {
        $this->validate(
            $request,
            [
                's_ProviderName' => 'required',
                'productName' => 'required',
                'Address' => 'required',
                'status' => 'required',
                'note' => 'required',
                'serviceProviderId' => 'required',
            ],
        );
        $var = Service::find($request->id);
        $var->s_ProviderName = $request->s_ProviderName;
        $var->productName = $request->productName;
        $var->Address = $request->Address;
        $var->status = $request->status;
        $var->note = $request->note;
        $var->serviceProviderId= $request->serviceProviderId;
        $var->update();
        $request->session()->flash('note-update', 'Note Updated Successfully!');
        return redirect('/serviceNoteList/'. session('id'));
    
    }
}