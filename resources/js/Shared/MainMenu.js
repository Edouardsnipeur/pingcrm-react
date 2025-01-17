import React from 'react';
import MainMenuItem from '@/Shared/MainMenuItem';

export default ({ className }) => {
  return (
    <div className={className}>
      <MainMenuItem text="Dashboard" link="dashboard" icon="dashboard" />
      {/* <MainMenuItem text="Organizations" link="organizations" icon="office" /> */}
      <MainMenuItem text="Secteurs d'activité" link="secteurs" icon="office" />
      <MainMenuItem text="Categories" link="categories" icon="office" />
      <MainMenuItem text="Photos" link="photos" icon="office" />
      {/* <MainMenuItem text="Contacts" link="contacts" icon="users" />
      <MainMenuItem text="Reports" link="reports" icon="printer" /> */}
    </div>
  );
};
