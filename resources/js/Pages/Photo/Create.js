import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage, useForm } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import FileInput from '@/Shared/FileInput';
import SelectInput from '@/Shared/SelectInput';

const Create = () => {
  const { categories,  secteurs} = usePage().props;
  const { data, setData, errors, post, processing } = useForm({
    photos: [],
    category_id: '',
    secteur_id: '',
  });

  function handleSubmit(e) {
    e.preventDefault();
    post(route('photos.store'));
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <InertiaLink
          href={route('photos')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          Photos 
        </InertiaLink>
        <span className="font-medium text-indigo-600"> /</span> Creer
      </h1>
      <div className="max-w-3xl overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="flex flex-wrap p-8 -mb-8 -mr-6">
          <SelectInput
              className="w-full pb-8 pr-6"
              label="Secteur des photos"
              name="secteur_id"
              errors={errors.secteur_id}
              value={data.secteur_id}
              onChange={e => setData('secteur_id', e.target.value)}
            >
              <option value=""></option>
              {secteurs.map(({ id, name }) => (
                <option key={id} value={id}>
                  {name}
                </option>
              ))}
            </SelectInput>
            <SelectInput
              className="w-full pb-8 pr-6"
              label="Categorie de photos"
              name="category_id"
              errors={errors.category_id}
              value={data.category_id}
              onChange={e => setData('category_id', e.target.value)}
            >
              <option value=""></option>
              {categories.map(({ id, name }) => (
                <option key={id} value={id}>
                  {name}
                </option>
              ))}
            </SelectInput>
            <FileInput
              className="w-full pb-8 pr-6"
              label="Selectionner les photos"
              name="photos"
              accept="jpg,png,jpeg"
              errors={errors.photos}
              value={data.photos}
              onChange={e => setData('photos', e)}
            />
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              Ajouter les photos
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = page => <Layout title="Ajouter les photos" children={page} />;

export default Create;
