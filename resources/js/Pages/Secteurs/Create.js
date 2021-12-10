import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';

const Create = () => {
  // const { secteurs } = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    s_name: "",
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('secteurs.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('secteurs')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          secteurs
        </InertiaLink>
        <span className="font-medium text-indigo-600"> /</span> Creer
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">
            <TextInput
              className="w-full pb-8 pr-6 lg:w-1/2"
              label="Nom du secteur"
              name="s_name"
              errors={errors.s_name}
              value={data.s_name}
              onChange={e => setData('s_name', e.target.value)}
            />
            
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Ajouter les secteurs
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Ajouter les secteurs" children={page} />;

export default Create;
