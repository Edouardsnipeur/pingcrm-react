import React from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';
import DeleteButton from '@/Shared/DeleteButton';

const Index = () => {
  const { secteurs } = usePage().props;
  const {
    data,
    meta: { links }
  } = secteurs;
  function destroy(id) {
    if (confirm('Vous êtes vraiment sûr de suprimer cette catégorie?')) {
      Inertia.delete(route('secteurs.destroy', id));
    }
  }
  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">Mes secteurs</h1>
      <div className="flex items-center justify-between mb-6">
        <SearchFilter />
        <InertiaLink
          className="btn-indigo focus:outline-none"
          href={route('secteurs.create')}
        >
          <span>Ajouter</span>
          <span className="hidden md:inline">secteurs</span>
        </InertiaLink>
      </div>
      <div className="overflow-x-auto bg-white rounded shadow">
        <table className="w-full whitespace-nowrap">
          <thead>
            <tr className="font-bold text-left">
              <th className="px-6 pt-5 pb-4">Nom</th>
            </tr>
          </thead>
          <tbody>
            {data.map(({ id, name}) => {
              return (
                <tr
                  key={id}
                  className="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                  <td className="border-t">
                    <InertiaLink
                      href={route('organizations.edit', id)}
                      className="flex items-center px-6 py-4 focus:text-indigo-700 focus:outline-none"
                    >
                      {name}
                    </InertiaLink>
                  </td>
                  <td className="border-t">
                    <DeleteButton onDelete={()=>destroy(id)}>
                      Supprimer le secteur
                    </DeleteButton>
                  </td>
                </tr>
              );
            })}
            {data.length === 0 && (
              <tr>
                <td className="px-6 py-4 border-t" colSpan="4">
                  Aucun secteur.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
      <Pagination links={links} />
    </div>
  );
};

Index.layout = page => <Layout title="Organizations" children={page} />;

export default Index;